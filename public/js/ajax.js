function destroy(button){
    const idProduto = button.getAttribute('data-produto-id')

    const trObject = $(this)

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $.ajax({
        type: "DELETE",
        url: `/produtos/meus-produtos/destroy/${idProduto}`,
        dataType: "json",
        success: function (response) {
            alert(response.success);
            location.reload()    
        },
        error: (xhr, status, error) =>{
            alert(`Status: ${status}\nError:${error}\nxhr: ${xhr}`)
        }
    });

}