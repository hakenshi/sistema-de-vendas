const search = $("#search")

const listaProduto = []

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

function removeFromList(button){

    

    const indexToRemove = button.closest('tr').index()

    console.log(indexToRemove);


}

function addToList(button) {
    const id = button.getAttribute('data-id')
    $.ajax({
        type: "get",
        url: `/vendas/nova-venda/${id}`,
        dataType: 'json',
        success: function (response) {

            const alreadyInList = listaProduto.some(item => item.id === response.produto.id)

            if (!alreadyInList) {

                $("#lista").html('')

                listaProduto.push(response.produto)



                const produtos = listaProduto.map(produto => {
                    return $(`
                <tr>
                <td><img class="product-image" src="/storage/server/${produto.imagem_produto}" alt="{{ $produto->nome_produto }}"></td>
                <td>${produto.nome_produto}</td>
                <td>R$ ${produto.valor_produto}</td>
                <td><input min="1" max="100" value="1" type="number" name="quantidade" id="quantidade" ></td>
                <td>${produto.descricao_produto}</td>
                <td><button class="btn btn-danger" onclick="removeFromList(this, id)">Remover</button></td>
                </tr>
              `);
                })

                $("#lista").append(produtos)
            }

            else alert('Produto já na lista.')
        },
        error: (xhr, status, error) => {
            console.error(`Status: ${status}\nError:${error}\nxhr: ${xhr.error}`)
        }
    });

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


