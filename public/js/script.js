$(() => {
    const imagemProduto = $("#image")

    imagemProduto.on('change', () => {
        const file = imagemProduto[0].files[0]

        if (file) {
            img = URL.createObjectURL(file)
            $("#preview").attr('src', img)
        }
    }
    )
})