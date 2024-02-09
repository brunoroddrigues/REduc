function criarCard2(img, titulo, descritivo, data, link) {

    const card2 = document.createElement("div")
    card2.setAttribute("class", "card my-3")

    const linha = document.createElement("div")
    linha.setAttribute("class", "row g-0")

    const col1 = document.createElement("div")
    col1.setAttribute("class", "col-lg-4")

    const col2 = document.createElement("div")
    col2.setAttribute("class", "col-lg-8")

    const cardImg = document.createElement("img")
    let src = (img !== null) ? img : "img/img-padrao.jpg";
    cardImg.setAttribute("src", src)
    cardImg.setAttribute("class", "img-fluid rounded-start img-card")
    cardImg.setAttribute("alt", "Foto da prática avaliativa")

    const cardBody = document.createElement("div")
    cardBody.setAttribute("class", "card-body")

    const cardTitle = document.createElement("h3")
    cardTitle.setAttribute("class", "card-title")
    cardTitle.appendChild(document.createTextNode(titulo))

    const cardDesc = document.createElement("p")
    cardDesc.setAttribute("class", "card-text")
    cardDesc.appendChild(document.createTextNode(descritivo))

    const cardDate = document.createElement("p")
    cardDate.setAttribute("class", "card-text")

    const small = document.createElement("small")
    small.setAttribute("class", "text-muted")
    small.appendChild(document.createTextNode("Enviado em: "))
    small.appendChild(document.createTextNode(data))

    cardDate.appendChild(small)

    const acessar = document.createElement("a")
    acessar.setAttribute("class", "btn btn-primary card-btn")
    acessar.setAttribute("href", link)
    acessar.appendChild(document.createTextNode("Acessar"))

    cardBody.appendChild(cardTitle)
    cardBody.appendChild(cardDesc)
    cardBody.appendChild(acessar)

    col1.appendChild(cardImg)

    col2.appendChild(cardBody)

    linha.appendChild(col1)
    linha.appendChild(col2)

    card2.appendChild(linha)

    document.getElementById("card2-container").appendChild(card2)
}

// criarCard2(null, "Vídeo de carro", "Um vídeo sobre carros que eu achei na internet", "05/10/2023", "https://www.youtube.com/watch?v=vbI2K4xxQ5Y");