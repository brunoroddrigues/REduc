// Declaração das variáveis
const FORM_CADASTRO = document.querySelector("#form-cadastro");
const CAT_USER = document.querySelector(".cat-user");
const DADOS_PESSOAIS = document.querySelector(".dados-pessoais");
const DADOS_INSTITUCIONAIS = document.querySelector(".institucional");
const DADOS_SEGURANÇA = document.querySelector(".seguranca");
const BTNS_CONTROLE = document.querySelectorAll(".btn-controle");
const RADIO_BUTTONS = document.getElementsByName("categoria");
var form_index = 1;
var entrou = false;

// Bloqueio de envio de formulário dos botões
BTNS_CONTROLE[0].addEventListener("click", function (event) {
  event.preventDefault();
  if (form_index > 1) {
    form_index--;
  }
});

BTNS_CONTROLE[1].addEventListener("click", function (event) {
  event.preventDefault();
  if (form_index <= 4) {
    form_index++;
  }
});

// Funções auxiliares
function addClasseNone(elemento) {
  if (!elemento.classList.contains("d-none")) {
    elemento.classList.add("d-none");
  }
}

function removeClassNone(elemento) {
  if (elemento.classList.contains("d-none")) {
    elemento.classList.remove("d-none");
  }
}

// Definir os inputs de acordo com a categoria do usuário:
// 1. Professor: insere inputs de lattes e area de atuação
// 2. Aluno: dados padões, porém ele exclui os inputs dos professores
RADIO_BUTTONS[0].addEventListener("click", checkInput);
RADIO_BUTTONS[1].addEventListener("click", checkInput);

function checkInput() {
  
  // Declarar variaveis lattes
  if(!entrou)
  {
  let dados = document.createElement("div");
  dados.setAttribute("id", "prof");
  let labelLattes = document.createElement("label");
  let inputLattes = document.createElement("input");
  // Declarar variaveis area de atuação
  let labelAtuacao = document.createElement("label");
  let inputAtuacao = document.createElement("input");
  // quebra de linha
  let br1 = document.createElement("br");
  let br2 = document.createElement("br");
  let br3 = document.createElement("br");
  if (RADIO_BUTTONS[1].checked) {
    
     entrou = true
      // Atribuições dos textos
      labelLattes.appendChild(
        document.createTextNode("Link do currículo Lattes:")
      );
      labelAtuacao.appendChild(document.createTextNode("Área de atuação:"));

      // input Lattes atributos
      inputLattes.setAttribute("class", "form-control");
      inputLattes.setAttribute("type", "text");
      inputLattes.setAttribute("name", "linkLattes");
      inputLattes.setAttribute("placeholder", "Insira o link do Lattes...");
      inputLattes.setAttribute("required", "true");

      // input atuação atributos
      inputAtuacao.setAttribute("class", "form-control");
      inputAtuacao.setAttribute("type", "text");
      inputAtuacao.setAttribute("name", "area");
      inputAtuacao.setAttribute("placeholder", "Digite sua área de atuação...");
      inputAtuacao.setAttribute("required", "true");

      // Criar elementos
      // Lattes
     /* DADOS_INSTITUCIONAIS.appendChild(labelLattes);
      DADOS_INSTITUCIONAIS.appendChild(br1);
      DADOS_INSTITUCIONAIS.appendChild(inputLattes);
      DADOS_INSTITUCIONAIS.appendChild(br2);
      // Área de atuação
      DADOS_INSTITUCIONAIS.appendChild(labelAtuacao);
      DADOS_INSTITUCIONAIS.appendChild(br3);
      DADOS_INSTITUCIONAIS.appendChild(inputAtuacao);*/
       
      dados.appendChild(labelLattes);
      dados.appendChild(br1);
      dados.appendChild(inputLattes);
      dados.appendChild(br2);
      // Área de atuação
      dados.appendChild(labelAtuacao);
      dados.appendChild(br3);
      dados.appendChild(inputAtuacao);
      DADOS_INSTITUCIONAIS.appendChild(dados);
  }
    
  } else {
      if(entrou)
      {
       DADOS_INSTITUCIONAIS.removeChild(document.getElementById("prof"));
       entrou = false;
      }

  }
}

// Alterar as páginas do formulário
function carregarForm() {
  setInterval(function () {
    switch (form_index) {
      case 1:
        removeClassNone(CAT_USER);
        addClasseNone(DADOS_PESSOAIS);
        break;
      case 2:
        addClasseNone(CAT_USER);
        addClasseNone(DADOS_INSTITUCIONAIS);
        removeClassNone(DADOS_PESSOAIS);
        break;
      case 3:
        addClasseNone(DADOS_PESSOAIS);
        addClasseNone(DADOS_SEGURANÇA);
        removeClassNone(DADOS_INSTITUCIONAIS);
        addClasseNone(BTNS_CONTROLE[2]);
        removeClassNone(BTNS_CONTROLE[1]);
        break;
      case 4:
        addClasseNone(DADOS_INSTITUCIONAIS);
        removeClassNone(DADOS_SEGURANÇA);
        addClasseNone(BTNS_CONTROLE[1]);
        removeClassNone(BTNS_CONTROLE[2]);
        break;
    }
  });
}
