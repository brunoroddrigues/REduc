export function criarRodape(){
    const FOOTER = document.getElementById("reduc-footer");
    if(!FOOTER.classList.contains("container-fluid")){
        FOOTER.classList.add("container-fluid")
    }
    if(!FOOTER.classList.contains("d-flex")){
        FOOTER.classList.add("d-flex")
    }
    if(!FOOTER.classList.contains("align-items-center")){
        FOOTER.classList.add("align-items-center")
    }
    
    // Textos do rodapé
    let txtH2 = document.createTextNode("REduc")
    let copyrightTxt = document.createTextNode("Todos os direitos reservados")
    let link1 = document.createTextNode("Inicio")
    let link2 = document.createTextNode("Explorar");

    let divContainer = document.createElement("div")
    divContainer.setAttribute("class", "container text-light d-flex align-items-center justify-content-between")
    let divElementos = document.createElement("div")

    let h2 = document.createElement("h2")
    let p = document.createElement("p")
    let ul = document.createElement("ul")
    let li1 = document.createElement("li")
    let li2 = document.createElement("li")
    let a1 = document.createElement("a")
    let a2 = document.createElement("a")
    let img = document.createElement("img")
    let i = document.createElement("i")

    h2.setAttribute("class", "marca")
    p.setAttribute("class", "mx-2")
    ul.setAttribute("class", "list-inline")
    li1.setAttribute("class", "list-inline-item")
    li2.setAttribute("class", "list-inline-item")
    a1.setAttribute("class", "btn text-light")
    a2.setAttribute("class", "btn text-light")
    a1.setAttribute("href", "index.html")
    a2.setAttribute("href", "explorar.html")
    img.setAttribute("src", "img/logo.svg")
    img.setAttribute("alt", "Logo REduc")
    i.setAttribute("class", "bi bi-c-circle")

    h2.appendChild(txtH2)
    p.appendChild(i)
    p.appendChild(copyrightTxt)
    a1.appendChild(link1)
    li1.appendChild(a1)
    a2.appendChild(link2)
    li2.appendChild(a2)
    ul.appendChild(li1)
    ul.appendChild(li2)
    divElementos.appendChild(h2)
    divElementos.appendChild(p)
    divElementos.appendChild(ul)
    divContainer.appendChild(divElementos)
    divContainer.appendChild(img)
    FOOTER.appendChild(divContainer)
}