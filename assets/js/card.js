const corpo = document.querySelector('#explorar');

function criarCard($imagem, $titulo, $estrelas, $flag){// Os parametros declarados com $ são parâmetros que receberemos via banco de dados, conversar com os orientadores sobre como faremos para pegar para poder escrever o script da melhor maneira.

    // Declara as variaveis dos elementos que serão criados via DOM
    const div1 = document.createElement('div')
    const div2 = document.createElement('div')
    const div3 = document.createElement('div')
    const a = document.createElement('a')
    const img = document.createElement('img')
    const h4 = document.createElement('h4')
    const span = document.createElement('span')
    const button = document.createElement('button')

    // Atribuindo as classes para os elementos
    div1.setAttribute('class', 'col-lg-3')
    div2.setAttribute('class', 'p1')
    a.setAttribute('class', 'card', 'link-reset', 'shadow')
    img.setAttribute('class', 'card-img-top')
    img.setAttribute('src', $imagem)
    div3.setAttribute('class', 'card-body')
    h4.setAttribute('class', 'card-title')
    span.setAttribute('class', 'card-star')
    button.setAttribute('class', 'btn', 'p-0', 'card-flag')

    // Atribuir o conteudo aos elementos

    // Titulo
    let titulo = document.createTextNode($titulo) // Aqui virá um dado vindo do Banco de dados
    h4.appendChild(titulo)

    // Estrelas
    let estrelaPreenchida = document.createTextNode('&#9733;')
    let estrelaContorno = document.createTextNode('&#9734;')
    let x;

    switch($estrelas){
        case 1:
            span.appendChild(estrelaPreenchida)
            for(x = 0; x < 4; x++){
                span.appendChild(estrelaContorno)
            }
            break;
        case 2:
            span.appendChild(estrelaPreenchida)
            span.appendChild(estrelaPreenchida)
            for(x = 0; x < 3; x++){
                span.appendChild(estrealaContorno)
            }
            break;
        case 3:
            for(x = 0; x < 3; x++){
                span.appendChild(estrelaPreenchida)
            }
            span.appendChild(estrelaContorno)
            span.appendChild(estrelaContorno)
            break;
        case 4:
            for(x = 0; x < 4; x++){
                span.appendChild(estrelaPreenchida)
            }
            span.appendChild(estrelaContorno)
            break;
        case 5:
            for(x = 0; x < 5; x++){
                span.appendChild(estrelaPreenchida)
            }
            break;
    }

    // Bandeira
    let bandeira = document.createTextNode('&#9873')
    let notBandeira = document.createTextNode('&#9872')

    if($flag){
        button.appendChild(bandeira)
    }else{
        button.appendChild(notBandeira)
    }

    // Card-body
    div3.appendChild(h4)
    div3.appendChild(span)
    div3.appendChild(button)

    // Card
    a.appendChild(img)
    a.appendChild(div3)

    // Divs de posicionamento
    div2.appendChild(a) 
    div1.appendChild(div2)

    // Inserir no body
    corpo.appendChild(div1)
}