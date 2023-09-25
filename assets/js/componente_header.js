export function criarHeader(){
    const HEADER = document.getElementById("reduc-header")

    let nav = document.createElement("nav")
    nav.setAttribute("class", "navbar navbar-dark navbar-expand-sm")
    
    let divContainer = document.createElement("div")
    divContainer.setAttribute("class", "container")

    let linkImg = document.createElement("a")
    linkImg.setAttribute("class", "navbar-brand d-flex align-items-center")
    linkImg.setAttribute("href", "index.html")

    let img = document.createElement("img")
    img.setAttribute("src", "img/logo.svg")
    img.setAttribute("alt", "Logo REduc")

    let marca = document.createElement("span")
    marca.setAttribute("class", "marca link-header")
    marca.appendChild(document.createTextNode("REduc"))

    let mbutton = document.createElement("button")
    mbutton.setAttribute("class", "navbar-toggler d-lg-none")
    mbutton.setAttribute("data-bs-toggle", "collapse")
    mbutton.setAttribute("data-bs-target", "#collapsibleNavId")

    let mspan = document.createElement("span")
    mspan.setAttribute("class", "navbar-toggler-icon")
    mbutton.appendChild(mspan)

    let div1 = document.createElement("div")
    div1.setAttribute("class", "collapse navbar-collapse justify-content-between")
    div1.setAttribute("id", "collapsibleNavId")

    let hform = document.createElement("form")
    // Lembrar de adicionar os action no formulario
    hform.setAttribute("action", "#")
    hform.setAttribute("method", "post")
    hform.setAttribute("class", "container d-flex")

    let input = document.createElement("input")
    input.setAttribute("type", "text")
    input.setAttribute("placeholder", "Digite o que procura...")
    input.setAttribute("class", "form-control")
    input.setAttribute("id", "barra-pesquisa-header")

    let sbutton = document.createElement("button")
    sbutton.setAttribute("type", "submit")
    sbutton.setAttribute("class", "btn btn-search")

    let icon = document.createElement("i")
    icon.setAttribute("class", "bi bi-search")
    sbutton.appendChild(icon)

    let ul = document.createElement("ul")
    ul.setAttribute("class", "navbar-nav mt-2 mt-lg-0")
    let li = []
    for(let i = 0; i < 4; i++){
        li[i] = document.createElement("li")
        li[i].setAttribute("class", "nav-item mx-2")
    }
    
    let aSobre = document.createElement("a")
    aSobre.setAttribute("class", "nav-link txt-branco link-header")
    aSobre.setAttribute("href", "#sobre")
    aSobre.appendChild(document.createTextNode("Sobre"))

    let aExplorar = document.createElement("a")
    aExplorar.setAttribute("class", "nav-link txt-branco link-header")
    aExplorar.setAttribute("href", "explorar.html")
    aExplorar.appendChild(document.createTextNode("Explorar"))

    let a1 = document.createElement("a")

    let a2 = document.createElement("a")

    // Inserir os elementos nos containers

    li[0].appendChild(aSobre)
    li[1].appendChild(aExplorar)
    li[2].appendChild(a1)
    li[3].appendChild(a2)

    for(let i = 0; i < 4; i++){
        ul.appendChild(li[i])
    }

    hform.appendChild(input)
    hform.appendChild(sbutton)

    div1.appendChild(hform)
    div1.appendChild(ul)

    linkImg.appendChild(img)
    linkImg.appendChild(marca)

    divContainer.appendChild(linkImg)
    divContainer.appendChild(mbutton)
    divContainer.appendChild(div1)

    nav.appendChild(divContainer)

    HEADER.appendChild(nav)
}