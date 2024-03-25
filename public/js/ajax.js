
function destroy(button,url){
    const id = button.getAttribute('data-id')

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $.ajax({
        type: "DELETE",
        url: url,
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