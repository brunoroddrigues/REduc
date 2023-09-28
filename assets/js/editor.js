const btn_bold = document.getElementById("font-bold");

var teste_bold = false;

btn_bold.addEventListener("click", function(){
    const bold = document.createElement("span")
    bold.setAttribute("class", "fw-bold");
    const userSelection = getSelection();
    const areaSelecionada = userSelection.getRangeAt(0);
    if(!teste_bold){
        teste_bold = true;
        areaSelecionada.surroundContents(bold);
    }
    else{
        teste_bold = false;
        
    }
})