function criarCard() {
    // Obtém o texto digitado 
    var textoDigitado = document.getElementById("textoInput").value;

    //Incio do Card
    var novoCard = document.createElement("div");
    novoCard.setAttribute("class", " card m-4 ");

    var cardheader = document.createElement("div");
    cardheader.setAttribute("class", "card-header");
    cardheader.setAttribute("style", "background-color: #131267;");

    var img = document.createElement("i");
    img.setAttribute("class", "bi bi-person-circle")
    img.setAttribute("style", "font-size: 50px; color:white")

    var cardbody = document.createElement("div");
    cardbody.setAttribute("class", "card-body");
    cardbody.textContent = textoDigitado;

    var cardfooter = document.createElement("div");
    cardfooter.setAttribute("class", "card-footer bg-transparent row");

    var date = document.createElement("div");
    date.setAttribute("class", "col");
    date.textContent = "Postado 20/07/2023"

    var bot = document.createElement("div"); // Coluna do Botão
    bot.setAttribute("class", "col");

    var botao = document.createElement("div") //Div que coloca o botão no lugar
    botao.setAttribute("class", "d-flex justify-content-end")

    var den = document.createElement("button") // botão de denunciar
    den.setAttribute("class", "btn btn-primary text-light")
    den.setAttribute("data-bs-toggle", "modal")
    den.setAttribute("data-bs-targeet", "#opicao")
    den.textContent = "Denuncia";

    //Fim

    //Modal

    var modal = document.createElement("div")
    modal.setAttribute("class", "modal fade")
    modal.setAttribute("data-bs-toggle", "modal")
    modal.setAttribute("id", "opicao")

    var modaldi = document.createElement("div")
    modaldi.setAttribute("class", "modal-dialog")

    var modalco = document.createElement("div")
    modalco.setAttribute("class", "modal-content")

    var modalheader = document.createElement("div") //Header
    modalheader.setAttribute("class", " modal-header")

    var titulo = document.createElement("h1")
    titulo.setAttribute("class", "modal-title fs-5")

    var sair = document.createElement("button")
    sair.setAttribute("calss", "btn-close")
    sair.setAttribute("data-bs-dismiss", "modal")

    var modalbody = document.createElement("div")  //Body
    modalbody.setAttribute("class", "modal-body")

    var modalfooter = document.createElement("div") //Footer
    modalfooter.setAttribute("class", "modal-footer")


    //Fim

    //Card

    novoCard.appendChild(cardheader);
    cardheader.appendChild(img)

    novoCard.appendChild(cardbody);

    novoCard.appendChild(cardfooter);
    cardfooter.appendChild(date);
    cardfooter.appendChild(bot);
    bot.appendChild(botao);
    botao.appendChild(den)

    //Fim do Card

    //Modal

    den.appendChild(modal)
    modal.appendChild(modaldi)
    modaldi.appendChild(modalco)

    modalco.appendChild(modalheader) //Header
    modalheader.appendChild(titulo)
    modalheader.appendChild(sair)

    modalco.appendChild(modalbody) //Body

    modalco.appendChild(modalfooter) //Footer

    //fim

    document.getElementById("cards").appendChild(novoCard);


    document.getElementById("textoInput").value = "";
}