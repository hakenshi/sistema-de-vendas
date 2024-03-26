$(() => {
    const imagemProduto = $("#image")

    const openButton = $("#open_btn")

    const sideItem = $(".side_item")

    imagemProduto.on('change', () => {
        const file = imagemProduto[0].files[0]

        if (file) {
            img = URL.createObjectURL(file)
            $("#preview").attr('src', img)
        }
    }
    )

    openButton.on('click', ()=>{
        $("#sidebar").toggleClass('open-sidebar')
    })

    $("#cpf").mask('000.000.000-00', {reverse: true})

    $("#valor-produto").mask('#.##0,00', {reverse: true})

    $("#data-nascimento").mask('00/00/0000')

})