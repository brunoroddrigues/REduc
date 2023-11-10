
function criarCards(qtd){
    console.log("chamou")
    $.ajax({
        url: "card-data.php",
        type: "post",
        dataType: "json",
        data: {
            quantidade: qtd
        },
        success: (resposta)=>{
            resposta.forEach(recurso => {
                criarCard(recurso.img_recurso_path, recurso.titulo, recurso.nota);
            });
        },
        error: () => {
            console.log("Não foi possível realizar a operação!");
        }
    })
}

// export default criarCards;