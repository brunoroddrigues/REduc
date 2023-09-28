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
var test = false;
var entrada_validacao = false;

// Bloqueio de envio de formulário dos botões
BTNS_CONTROLE[0].addEventListener("click", function (event) {
  event.preventDefault();
  if (form_index > 1) {
    form_index--;
  }
});

BTNS_CONTROLE[1].addEventListener("click", function (event) {
  event.preventDefault();
  ValidarForm(form_index)
  if (test) {
    if (form_index <= 4) {
      form_index++;
    }
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

// Funcção de validação do formulário
function ValidarForm(form_index) {
  if (form_index == 1) {
    var cat_btn = document.getElementsByName("categoria");
    var error_cat_user = document.getElementById("error_cat-user");
    if (!cat_btn[0].checked && !cat_btn[1].checked) {
      if (!entrada_validacao) {
        var lbl_prof = document.getElementById("label_professor");
        var br_lbl = document.createElement("br");

        lbl_prof.insertAdjacentElement("afterend", br_lbl);
        error_cat_user.appendChild(
        document.createTextNode("Escolha uma categoria!")
        )
        entrada_validacao = true;
      }
      test = false;
    }else {
      addClasseNone(error_cat_user);
      test = true;
    }
  }else if (form_index == 2) {
    var inpt_username = document.getElementById('username');
    if (inpt_username.value == "") {
      if (!entrada_validacao) {
        
        var error_username = document.getElementById("error_username");
        var br_username = document.createElement("br");
  
        error_username.appendChild(
          document.createTextNode("Escolha seu nome de usuario!")
        );
        error_username.appendChild(br_username)
        test = false;
        entrada_validacao = true;
        console.log(entrada_validacao)
      } else {
        entrada_validacao = true;
      }
    } else {
      test = true;
    }
  }
}


// A funcção de validação será chamada toda vez que o usuario clicar no botao de avançar
// Na função de validação vou usar o form_index que indicará em qual 'etapa'
// estamos, depois vou pegar o conteudo que esta presente na página e fazer o teste

/** Atualização sobre a funcção de validação:
 * Ainda na página de dados pessoas;
 * Quando o erro do username aparece e eu clico para avançar mais de uma vez, ele não acrescente mais de um elemento, 
 * porém se eu apertar para voltar e depois apertar para anvaçar ele ele acrescenta.
 * Arrumar!!!!
 */