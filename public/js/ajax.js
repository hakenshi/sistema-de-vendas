
const search = $("#search")

const listaProduto = []

const quantidades = []

const desconto = $("#desconto")

const store = $("#store")

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

    let total = $("#total").text().trim()
    total = total.replace(/\s+/g, '').replace('ValorTotal:R$', '');

   const totalFloat = parseFloat(total -= valorProduto * quantidade)

    $("#total").text(`Valor Total: R$ ${Math.round(totalFloat * 100) / 100}`);

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

                $(".quantidade").on('keypress keyup blur change', ()=>{
                calculaTotal()
                calculaQuantidade()
            })
                desconto.on('keypress keyup blur change', ()=>{
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
    $("#lista > tr").each(function(){
        const quantidade = Number($(this).find('.quantidade').val());
        total += quantidade
    });
    $("#quantidade-total").val(total)
}


function destroy(button, url) {
    const id = button.getAttribute('data-id')

    $.ajax({
        type: "DELETE",
        url: url,
        dataType: "json",
        success: function (response) {
            alert(response.success);
            location.reload()
        },
        error: (xhr, status, error) => {
            alert(`Status: ${status}\nError:${error}\nxhr: ${xhr.error}`)
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

store.on('click', e =>{    
   const quantidades =  $("#lista > tr").map(function(){
        return $(this).find('.quantidade').val();
    }).get()

    $.ajax({
        type: "post",
        url: "/venda/store",
        data:{
            produtos: listaProduto,
            quantidades: quantidades,
            valorTotal: $("#total-input").val(),
            quantidadeTotal: $("#quantidade-total").val(),
            desconto: $("#desconto").val(),
        },
        dataType: "json",
        success: function (response) {
            if(response.code === 200){
            alert(response.mensagem)
            window.location.href = response.redirect_url

            }
        },
        error: (xhr, status, error) => {
            console.log(`xhr: ${xhr.error}\nstatus: ${status}\nerror: ${error}\n`);
        }
    });
})