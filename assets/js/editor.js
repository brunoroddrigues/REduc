/*
Link da documentação do obj selection < https://developer.mozilla.org/pt-BR/docs/Web/API/Selection >
*/

const teste = document.getElementById("teste")

teste.addEventListener("click", function(){
    const selecao = getSelection()
    console.log(selecao)
    if(selecao.anchorNode != null && selecao.focusNode != null){
        // console.log("existe seleção")
        document.getElementsByClassName("fw-bold")
        if(!selecao.containsNode("span", false)){
            
        }
    } else {
        // console.log("ñ existe seleção")

    }
})