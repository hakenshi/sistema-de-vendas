
function destroy(button){
    const id = button.getAttribute('data-id')

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $.ajax({
        type: "DELETE",
        url: `/delte-user/${id}`,
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