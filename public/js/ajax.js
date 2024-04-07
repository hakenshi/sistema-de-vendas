const search = $("#search")

const desconto = $("#desconto")

const store = $("#store")

const listaProduto = []

const editarListaProduto = []

const quantidades = []

const confirmationBtn = Swal.mixin({
    customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger"
    },
    buttonsStyling: false
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

function removeFromList(button, valorProduto, array = []) {
    const tr = $(button).closest('tr')
    const indexToRemove = $(button).closest('tr').index()
    const quantidade = Number(tr.find('.quantidade').val())

    const quantidadeAtual = $("#quantidade-total").val()
    let total = $("#total-input").val()


    // console.log(editarListaProduto)

    if (editarListaProduto.length === 1) {
        destroy(button, `/venda/delete/${editarListaProduto[0].id}`).then(() => {
            tr.remove()

            return
        })

    }


    array.splice(indexToRemove, 1)

    total -= valorProduto * quantidade

    if (isNaN(total)) {
        $("#total").text(`Valor Total: R$ 0.00`);
    }

    else {
        $("#total-input").val(parseFloat(total).toFixed(2))
        $("#total").text(`Valor Total: R$ ${parseFloat(total).toFixed(2)}`);
    }

    $("#quantidade-total").val(quantidadeAtual - quantidade)


    tr.remove()


}

function addToList(button) {
    const id = button.getAttribute('data-id')

    $.ajax({
        type: "get",
        url: `/vendas/nova-venda/${id}`,
        dataType: 'json',
        success: function (data) {


            const alreadyInList = listaProduto.some(item => item.produto.id === data.produto.id)

            if (!alreadyInList) {
                listaProduto.push({
                    produto: data.produto,
                    quantidade: 1
                })

                $("#lista").empty().append(geraLista())
                calculaQuantidade()

                $(".quantidade").on('keypress keyup blur change input', () => {
                    calculaTotal()
                    calculaQuantidade()
                })
                desconto.on('keypress keyup blur change input', () => {

                    if ($(desconto).val() == "") $(desconto).val("0")

                    calculaTotal($(desconto).val())

                })



                calculaTotal()
            }

            else alert('Produto já na lista.')
        },
        error: (xhr, status, error) => {
            console.error(`Status: ${status}\nError:${error}\nxhr: ${xhr.error}`)
        }
    });

}

function geraLista() {
    const produtos = listaProduto.map(item =>
        $(`
        <tr>
        <td><img class="product-image" src="/storage/server/${item.produto.imagem_produto}" alt="{{ $produto->nome_produto }}"></td>
        <td>${item.produto.nome_produto}</td>
        <input class="preco" type="hidden" value="${item.produto.valor_produto}">
        <td >R$ ${item.produto.valor_produto}</td>
        <td><div class="w-25"><input min="1" max="100" value="1" type="number" class="quantidade" name="quantidade" ></div></td>
        <td><button class="btn btn-danger" onclick="removeFromList(this, ${item.produto.valor_produto}, listaProduto)">Remover</button></td>
        </tr>
      `
        ))
    return produtos
}

function calculaTotal(desconto = 0) {
    let total = 0;

    $("#lista > tr").each(function () {
        const quantidade = $(this).find('.quantidade').val()
        const preco = $(this).find('.preco').val()

        total += quantidade * preco * (1 - desconto / 100)

    })
    $("#total-input").val(parseFloat(total).toFixed(2))
    $("#total").text(`Valor Total: R$ ${parseFloat(total).toFixed(2)}`);
}
function calculaQuantidade() {
    let total = 0;
    $("#lista > tr").each(function () {
        const quantidade = Number($(this).find('.quantidade').val());
        total += quantidade
    });
    $("#quantidade-total").val(total)
}


function destroy(button, url) {
    const id = button.getAttribute('data-id')


    confirmationBtn.fire({
        title: "Tem certeza que deseja excluir?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'Excluir',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then(result => {
        if (result.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: url,
                dataType: "json",
                success: function (response) {
                    confirmationBtn.fire({
                        title: "Deletado com sucesso.",
                        text: response.success,
                        icon: 'success'
                    }).then(() => {
                        location.reload()
                    })
                },
                error: (xhr, status, error) => {
                    alert(`Status: ${status}\nError:${error}\nxhr: ${xhr.error}`)
                }
            });
        }
        else if (result.dismiss === Swal.DismissReason.cancel) {
            confirmationBtn.fire({
                title: "Cancelado",
                icon: "error"
            })
        }

    })



}

function showSellData(id) {
    $("#lista").empty();

    $.ajax({
        type: "get",
        url: `/venda/`,
        data: { id: id },
        dataType: "json",
        success: function (response) {

            const produtosHtml = response.produtos.data.map(produto => {
                editarListaProduto.push(produto)
                return `
                    <tr>  
                        <td><img class="product-image" src="/storage/server/${produto.imagem_produto}" alt="{{ $produto->nome_produto }}"></td>
                        <td>${produto.nome_produto}</td>
                        <input class="preco" type="hidden" value="${produto.valor_produto}">
                        <td><input type="hidden" value="${produto.valor_produto}"> </td>
                        <td><span>R$ ${produto.valor_produto}</span></td>
                        <td><div class="w-25"><input min="1" disabled max="100" value="${produto.quantidade}" type="number" class="quantidade" name="quantidade" ></div></td>
                        <td class="hora-venda">${produto.hora_venda}</td>
                    </tr>`;
            });
            $("#quantidade-total").hide()
            $("#lista").html(produtosHtml.join(''));
            $("lista").html(`<input id="id" type="hidden" value="${editarListaProduto[0].id}">`);
            $("#total").html(`Valor total: R$ ${editarListaProduto[0].valor_venda}`);

            $("#lista").append(`<td><input id="total-input" type="hidden" value="${parseFloat(editarListaProduto[0].valor_venda)}"> </td>`)
            $("#total").append(`<td><input id="desconto" type="hidden" value="${editarListaProduto[0].valor_venda}"> </td>`)

            $(".quantidade").on('keypress keyup blur change', () => {
                calculaTotal()
                calculaQuantidade()
            })

        },
        error: (xhr, status, error) => {
            console.log(`xhr: ${xhr.error}\nstatus: ${status}\nerror: ${error}\n`);
        }
    });
}


search.on('keyup', function () {
    value = $(this).val()

    $.ajax({
        type: "get",
        url: "/venda/search",
        data: { search: value },
        success: function (data) {

            if (value === '') $('#search-container').html('')

            else $('#search-container').html(data)
        },
        error: (xhr, status, error) => {
            console.log(`xhr: ${xhr.error}\nstatus: ${status}\nerror: ${error}\n`);
        }

    });

})


store.on('click', e => {
    const quantidades = $("#lista > tr").map(function () {
        return $(this).find('.quantidade').val();
    }).get()

    $.ajax({
        type: "post",
        url: "/venda/store",
        data: {
            produtos: listaProduto,
            quantidades: quantidades,
            valorTotal: $("#total-input").val(),
            quantidadeTotal: $("#quantidade-total").val(),
            desconto: $("#desconto").val(),
        },
        dataType: "json",
        success: function (response) {
            if (response.code === 200) {
                alert(response.mensagem)
                window.location.href = response.redirect_url

            }
        },
        error: (xhr, status, error) => {
            console.log(`xhr: ${xhr.error}\nstatus: ${status}\nerror: ${error}\n`);
        }
    });
})

$("#edit-button").on('click', () => {
    calculaQuantidade()
    const valorProduto = editarListaProduto.map(item => item.valor_produto)
    // console.log(valor_produto)
    $("#quantidade-total").show()
    $("#delete-button").hide()
    $("#edit-button").hide()
    $(".hora-venda").each(function () {
        $(this).hide()
    })

    $(".quantidade").each(function () {
        $(this).removeAttr('disabled');
    });

    $(".modal-title").text("Editando venda")
    $(".modal-footer").append(`<btn id="save-changes" class="btn btn-success"> Salvar </button>`)


    $("#lista > tr").each(function (index, row) {
        const valor_produto = valorProduto[index];
        $(row).append(
            `<td>
                <button class="btn btn-danger modal-delete-btn p-0" id="" onclick="removeFromList(this,${valor_produto},editarListaProduto)">
                    <ion-icon class="icon p-0" name="remove"></ion-icon>
                </button>
            </td>`
        );
    });

    $("#save-changes").on('click', () => {

        const id = $("#id").val()
        const quantidadeTotal = $("#quantidade-total").val()
        const valorTotal = $("#total-input").val()
        const quantidades = $("#lista > tr").map(function () {
            return $(this).find('.quantidade').val();
        }).get()

        $.ajax({
            type: "post",
            url: `/venda/editar-venda/${id}`,
            data: {
                produtos: editarListaProduto,
                quantidades: quantidades,
                quantidadeTotal: quantidadeTotal,
                valorTotal: valorTotal,
            },
            dataType: "json",
            success: function (response) {

                Swal.fire({
                    icon: "success",
                    title: response.success,
                    showConfirmButton: true,
                }).then(() => {

                    location.reload()
                })


            },
            error: (xhr, status, error) => {
                console.log(`xhr: ${xhr.error}\nstatus: ${status}\nerror: ${error}\n`);
            }
        });
    })
})

