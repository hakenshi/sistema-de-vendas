const search = $("#search")

const desconto = $("#desconto")

const store = $("#store")

const listaProduto = []

const editarProdutosLista = []

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

function removeFromList(button, valorProduto) {
    const tr = $(button).closest('tr')
    const indexToRemove = $(button).closest('tr').index()
    const quantidade = Number(tr.find('.quantidade').val())
    listaProduto.splice(indexToRemove, 1)
    const quantidadeAtual = $("#quantidade-total").val()
    let total = $("#total").text().trim()
    total = total.replace(/\s+/g, '').replace('ValorTotal:R$', '');
    const totalFloat = parseFloat(total -= valorProduto *   quantidade)

    $("#total").text(`Valor Total: R$ ${Math.round(totalFloat * 100) / 100}`);

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

                $(".quantidade").on('keypress keyup blur change', () => {
                    calculaTotal()
                    calculaQuantidade()
                })
                desconto.on('keypress keyup blur change', () => {
                    calculaTotal(desconto.val())

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
        <td><button class="btn btn-danger" onclick="removeFromList(this, ${item.produto.valor_produto})">Remover</button></td>
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
       }).then(result =>{
        if(result.isConfirmed){
            $.ajax({
                type: "DELETE",
                url: url,
                dataType: "json",
                success: function (response) {
                    confirmationBtn.fire({
                        title: "Deletado com sucesso.",
                        text: response.success,
                        icon: 'success'
                    }).then(()=>{
                        location.reload()
                    })
                },
                error: (xhr, status, error) => {
                    alert(`Status: ${status}\nError:${error}\nxhr: ${xhr.error}`)
                }
            });
        }
        else if(result.dismiss === Swal.DismissReason.cancel){
            confirmationBtn.fire({
                title: "Cancelado",
                icon: "error"
            })
        }

       })

       

}

function showSellData(id) {
    $("#modal-info").empty(); // Limpar o conteúdo antes de adicionar novos elementos
    $.ajax({
        type: "get",
        url: `/venda/`,
        data: { id: id },
        dataType: "json",
        success: function (response) {
            const produtosHtml = response.produtos.data.map(produto => {
                listaProduto.push(produto)
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
            $("#lista").html(produtosHtml.join(''));
            $("lista").html(`<input id="id" type="hidden" value="${response.produtos.data[0].id}">`);
            $("#total").html(`Valor total: R$ ${response.produtos.data[0].valor_venda}`);
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

$("#edit-button").on('click', ()=>{

    const quantiadade = listaProduto.map(item => item.valor_produto)


    $("#delete-button").hide()
    $("#edit-button").hide()
    $(".hora-venda").each(function(){
        $(this).hide()
    })
    
    $(".quantidade").each(function() { 
        $(this).removeAttr('disabled');
    });
    
    $(".modal-title").text("Editando venda")        
    $(".modal-footer").append(`<btn id="save-changes" class="btn btn-success"> Salvar </button>`)
    

    $("#lista > tr").each(function(index, row) {
        const quantidade = quantiadade[index];
        $(row).append(
            `<td>
                <button class="btn btn-danger p-0" id="modal-delete-btn" onclick="removeFromList(this,${quantidade})">
                    <ion-icon class="icon p-0" name="remove"></ion-icon>
                </button>
            </td>`
        );
    });
    
    $("#save-changes").on('click', ()=>{

        const id = $("#id").val()

        $.ajax({
            type: "post",
            url: `/venda/editar-venda/${id}`,
            data: {produtos: editarProdutosLista},
            dataType: "json",
            success: function (response) {
                console.log(JSON.parse(response))
            }
        });
    // }).then(()=>{
    // $("#edit-button").show()
    // $("#hora-venda").show()
    // $("#hora-venda").show()
    // $(".modal-title").text("Detalhes da venda")        

    })
})

