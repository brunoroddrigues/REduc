const CARD_CONTAINER = document.getElementsByClassName("card-container");

const BODY = document.getElementsByTagName("body");

BODY[0].addEventListener("load", criarCard(null, "Titulo do recurso", 5, false))

/*                || src || string || int || bool ||                   */
function criarCard(imagem, titulo, estrelas, salvo){
    let divCol = document.createElement("div");
    divCol.setAttribute("class", "col-lg-3");

    let divP = document.createElement("div");
    divP.setAttribute("class", "p-1");

    let cardA = document.createElement("a");
    cardA.setAttribute("class", "card link-reset shadow");

    let cardImg = document.createElement("img");
    cardImg.setAttribute("class", "card-img-top");
    let src = (imagem !== null) ? imagem : "img/img-padrao.jpg";
    cardImg.setAttribute("src", src);
    cardImg.setAttribute("alt", "Imagem do recurso");

    let divBody = document.createElement("div");
    divBody.setAttribute("class", "card-body");

    let h4 = document.createElement("h4");
    h4.setAttribute("class", "card-title");
    h4.appendChild(document.createTextNode(titulo));

    let span = document.createElement("span");
    span.setAttribute("class", "card-star");
    let nota = [];
    let i = 0;
    for(i = 0; i < 5; i++){
        nota[i] = document.createElement("i");
        nota[i].setAttribute("class", "bi bi-star mx-1");
    }
    for(i = 0; i < estrelas; i++){
        nota[i].classList.remove("bi-star");
        nota[i].classList.add("bi-star-fill");
    }
    for(i = 0; i < 5; i++){
        span.appendChild(nota[i]);
    }

    let button = document.createElement("button");
    button.setAttribute("class", "btn p-0 card-flag");
    let bandeira = document.createElement("i");
    bandeira.setAttribute("class", "bi bi-bookmark");
    if(salvo){
        bandeira.classList.remove("bi-bookmark");
        bandeira.classList.add("bi-bookmark-fill");
    }
    button.appendChild(bandeira);

    divBody.appendChild(h4);
    divBody.appendChild(span);
    divBody.appendChild(button);

    cardA.appendChild(cardImg);
    cardA.appendChild(divBody);

    divP.appendChild(cardA);

    divCol.appendChild(divP);

    for(let x = 0; x < CARD_CONTAINER.length; x++){
        CARD_CONTAINER[x].appendChild(divCol);
    }
}