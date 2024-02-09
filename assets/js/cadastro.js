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
/* Variáveis da função de validação */
var test = false;
var form1 = false;
var form2 = [false, false, false, false, false, false];
var form3 = [false, false, false];
var form4 = [false, false, false, false, false];

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

BTNS_CONTROLE[2].addEventListener("click", function (event) {
    ValidarForm(form_index)
    if (!test) {
        event.preventDefault();
    } else if (test) {
        BTNS_CONTROLE[2].click();
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
    if (!entrou) {
        let dados = document.createElement("div");
        dados.setAttribute("id", "prof");
        let lattes_erro = document.createElement("span");
        lattes_erro.setAttribute("id", "error_lattes");
        lattes_erro.setAttribute("class", "text-danger");
        let atuacao_erro = document.createElement("span");
        atuacao_erro.setAttribute("id", "error_atuacao");
        atuacao_erro.setAttribute("class", "text-danger");
        let labelLattes = document.createElement("label");
        let inputLattes = document.createElement("input");
        // Declarar variaveis area de atuação
        let labelAtuacao = document.createElement("label");
        let inputAtuacao = document.createElement("input");
        // quebra de linha
        let br1 = document.createElement("br");
        let br2 = document.createElement("br");
        let br3 = document.createElement("br");
        let br4 = document.createElement("br");
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
            inputLattes.setAttribute("id", "linkLattes");
            inputLattes.setAttribute("placeholder", "Insira o link do Lattes...");
            inputLattes.setAttribute("required", "true");

            // input atuação atributos
            inputAtuacao.setAttribute("class", "form-control");
            inputAtuacao.setAttribute("type", "text");
            inputAtuacao.setAttribute("name", "area");
            inputAtuacao.setAttribute("id", "area");
            inputAtuacao.setAttribute("placeholder", "Digite sua área de atuação...");
            inputAtuacao.setAttribute("required", "true");

            // Criar elementos

            dados.appendChild(labelLattes);
            dados.appendChild(br1);
            dados.appendChild(inputLattes);
            dados.appendChild(br2);
            dados.appendChild(lattes_erro);
            // Área de atuação
            dados.appendChild(labelAtuacao);
            dados.appendChild(br3);
            dados.appendChild(inputAtuacao);
            dados.appendChild(br4);
            dados.appendChild(atuacao_erro);
            DADOS_INSTITUCIONAIS.appendChild(dados);
        }

    } else {
        if (entrou) {
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
    var val = 0;
    if (form_index == 1) { // INÍCIO DA PÁGINA 1
        var cat_btn = document.getElementsByName("categoria");
        var error_cat_user = document.getElementById("error_cat-user");
        if (!cat_btn[0].checked && !cat_btn[1].checked) {
            if (!form1) {
                var lbl_prof = document.getElementById("label_professor");
                var br_lbl = document.createElement("br");

                lbl_prof.insertAdjacentElement("afterend", br_lbl);
                error_cat_user.appendChild(
                    document.createTextNode("Escolha uma categoria!")
                )
                form1 = true;
            }
            test = false;
        } else {
            while (error_cat_user.firstChild) {
                error_cat_user.removeChild(error_cat_user.firstChild)
            }
            test = true;
        }
    } else if (form_index == 2) { // TERMINO DA PÁGINA 1 E INÍCIO DA PÁGINA 2
        var username = document.getElementById('username');
        var nome = document.getElementById("nome");
        var sobrenome = document.getElementById("sobrenome");
        var email = document.getElementById("email");
        var cpf = document.getElementById("cpf");
        var dataNasci = document.getElementById("data_nascimento");
        var error_username = document.getElementById("error_username");
        var error_nome = document.getElementById("error_nome");
        var error_sobrenome = document.getElementById("error_sobrenome");
        var error_email = document.getElementById("error_email");
        var error_cpf = document.getElementById("error_cpf");
        var error_data = document.getElementById("error_data");
        var br1 = document.createElement("br");
        var br2 = document.createElement("br");
        var br3 = document.createElement("br");
        var br4 = document.createElement("br");
        var br5 = document.createElement("br");
        var br6 = document.createElement("br");

        if (username.value == "") {
            if (!form2[0]) {
                error_username.appendChild(
                    document.createTextNode("Você precisa escolher um nome de usuário!")
                );
                error_username.appendChild(br1);

                form2[0] = true;
                test = false;
            } else {
                test = false;
            }
        } else {
            while (error_username.firstChild) {
                error_username.removeChild(error_username.firstChild)
            }
            form2[0] = false;
        }
        if (nome.value == "") {
            if (!form2[1]) {
                error_nome.appendChild(
                    document.createTextNode("Você precisa informar seu nome!")
                );
                error_nome.appendChild(br2);

                form2[1] = true;
                test = false;
            } else {
                test = false;
            }
        } else {
            while (error_nome.firstChild) {
                error_nome.removeChild(error_nome.firstChild)
            }
            form2[1] = false;
        }
        if (sobrenome.value == "") {
            if (!form2[2]) {
                error_sobrenome.appendChild(
                    document.createTextNode("Você precisa informar seu sobrenome!")
                );
                error_sobrenome.appendChild(br3);

                form2[2] = true;
                test = false;
            } else {
                test = false;
            }
        } else {
            while (error_sobrenome.firstChild) {
                error_sobrenome.removeChild(error_sobrenome.firstChild)
            }
            form2[2] = false;
        }
        if (email.value == "") {
            if (!form2[3]) {
                error_email.appendChild(
                    document.createTextNode("Você precisa informar seu email!")
                );
                error_email.appendChild(br4);

                form2[3] = true;
                test = false;
            } else {
                test = false;
            }
        } else {
            while (error_email.firstChild) {
                error_email.removeChild(error_email.firstChild)
            }
            if (!validarEmail(email.value)) {
                error_email.appendChild(
                    document.createTextNode("O email que você digitou não é valido!")
                );
                error_email.appendChild(br4);
                form2[3] = true;
            } else {
                while (error_email.firstChild) {
                    error_email.removeChild(error_email.firstChild)
                }
                form2[3] = false;
            }
        }
        if (cpf.value == "") {
            if (!form2[4]) {
                error_cpf.appendChild(
                    document.createTextNode("Você precisa informar seu cpf!")
                );
                error_cpf.appendChild(br5);

                form2[4] = true;
                test = false;
            } else {
                test = false;
            }
        } else {
            while (error_cpf.firstChild) {
                error_cpf.removeChild(error_cpf.firstChild)
            }
            if (!validarCPF(cpf.value)) {
                error_cpf.appendChild(
                    document.createTextNode("O cpf que você digitou não é valido!")
                );
                error_cpf.appendChild(br5);
                form2[4] = true;
            } else {
                while (error_cpf.firstChild) {
                    error_cpf.removeChild(error_cpf.firstChild)
                }
                form2[4] = false;
            }
        }
        if (dataNasci.value == "") {
            if (!form2[5]) {
                error_data.appendChild(
                    document.createTextNode("Você precisa informar sua data de nascimento!")
                );
                error_data.appendChild(br6);

                form2[5] = true;
                test = false;
            } else {
                test = false;
            }
        } else {
            while (error_data.firstChild) {
                error_data.removeChild(error_data.firstChild)
            }
            if (!validarData(dataNasci.value)) {
                error_data.appendChild(
                    document.createTextNode("Data de nascimento não valida!")
                );
                error_data.appendChild(br6);
                form2[5] = true;
            } else {
                while (error_data.firstChild) {
                    error_data.removeChild(error_data.firstChild)
                }
                form2[5] = false;
            }
        }
        for (let x = 0; x < form2.length; x++) {
            if (form2[x]) {
                val++;
            }
        }
        if (val == 0) {
            test = true;
        } else {
            test = false;
        }
    } else if (form_index == 3) { // TERMINO DA PÁGINA 2 E INICIO DA PÁGINA 3
        var cat_btn = document.getElementsByName("categoria");
        var inst = document.getElementById("instituicao");
        var error_inst = document.getElementById("error_inst");
        var br_inst = document.createElement("br");
        if (cat_btn[0].checked) {
            if (inst.value == 0) {
                if (!form3[0]) {
                    error_inst.appendChild(
                        document.createTextNode("Escolha uma instituição!")
                    )
                    error_inst.appendChild(br_inst);

                    form3[0] = true;
                    test = false;
                } else {
                    teste = false;
                }
            } else {
                while (error_inst.firstChild) {
                    error_inst.removeChild(error_inst.firstChild)
                }
                form3[0] = false;
                test = true;
            }
        } else if (cat_btn[1].checked) {
            var lattes = document.getElementById("linkLattes");
            var area = document.getElementById("area");
            var error_lattes = document.getElementById("error_lattes");
            var error_atuacao = document.getElementById("error_atuacao");
            if (inst.value == 0) {
                if (!form3[0]) {
                    error_inst.appendChild(
                        document.createTextNode("Escolha uma instituição!")
                    )
                    error_inst.appendChild(br_inst);

                    form3[0] = true;
                    test = false;
                } else {
                    teste = false;
                }
            } else {
                while (error_inst.firstChild) {
                    error_inst.removeChild(error_inst.firstChild)
                }
                form3[0] = false;
            }
            if (lattes.value == "") {
                if (!form3[1]) {
                    var br_lattes = document.createElement("br");
                    error_lattes.appendChild(
                        document.createTextNode("Informe o link do seu currículo lattes")
                    )
                    error_lattes.appendChild(br_lattes);

                    form3[1] = true;
                    test = false;
                } else {
                    test = false;
                }
            } else {
                while (error_lattes.firstChild) {
                    error_lattes.removeChild(error_lattes.firstChild)
                }
                form3[1] = false;
            }
            if (area.value == "") {
                if (!form3[2]) {
                    var br_atuacao = document.createElement("br");
                    error_atuacao.appendChild(
                        document.createTextNode("Informe o link do seu currículo lattes")
                    )
                    error_atuacao.appendChild(br_atuacao);

                    form3[2] = true;
                    test = false;
                } else {
                    test = false;
                }
            } else {
                while (error_atuacao.firstChild) {
                    error_atuacao.removeChild(error_atuacao.firstChild)
                }
                form3[2] = false;
            }
            for (let x = 0; x < form3.length; x++) {
                if (form3[x]) {
                    val++;
                }
            }
            if (val == 0) {
                test = true;
            }
        }
    } else if (form_index == 4) { // TÉRMINO DA PÁGINA 3 E INÍCIO DA PÁGINA 4
        var senha1 = document.getElementById("senha1");
        var senha2 = document.getElementById("senha2");
        var pergunta = document.getElementById("pergunta");
        var resposta = document.getElementById("resposta");
        var error_senha1 = document.getElementById("error_senha1");
        var error_senha2 = document.getElementById("error_senha2");
        var error_diferentesenha = document.getElementById("error_diferentesenha");
        var error_pergunta = document.getElementById("error_pergunta");
        var error_resposta = document.getElementById("error_resposta");

        if (senha1.value == "") {
            if (!form4[0]) {
                var br_senha1 = document.createElement("br");
                error_senha1.appendChild(
                    document.createTextNode("Digite uma senha")
                )
                error_senha1.appendChild(br_senha1);

                form4[0] = true;
                test = false;
            } else {
                test = false;
            }
        } else {
            while (error_senha1.firstChild) {
                error_senha1.removeChild(error_senha1.firstChild)
            }
            form4[0] = false;
        }
        if (senha2.value == "") {
            if (!form4[1]) {
                var br_senha2 = document.createElement("br");
                error_senha2.appendChild(
                    document.createTextNode("Digite a senha novamente")
                )
                error_senha2.appendChild(br_senha2);

                form4[1] = true;
                test = false;
            } else {
                test = false;
            }
        } else {
            while (error_senha2.firstChild) {
                error_senha2.removeChild(error_senha2.firstChild)
            }
            form4[1] = false;
            var senhacheck = true;
        }
        if (senhacheck) {
            if (senha1.value != senha2.value) {
                if (!form4[2]) {
                    var br_senha2 = document.createElement("br");
                    error_diferentesenha.appendChild(
                        document.createTextNode("As duas senhas tem que ser igual!")
                    )
                    error_diferentesenha.appendChild(br_senha2);

                    form4[2] = true;
                    test = false;
                } else {
                    test = false;
                }
            } else {
                while (error_diferentesenha.firstChild) {
                    error_diferentesenha.removeChild(error_diferentesenha.firstChild)
                }
                form4[2] = false;
            }
        }
        if (pergunta.value == 0) {
            if (!form4[3]) {
                var br_pergunta = document.createElement("br");
                error_pergunta.appendChild(
                    document.createTextNode("Escolha uma pergunta de segurança")
                )
                error_pergunta.appendChild(br_pergunta);

                form4[3] = true;
                test = false;
            } else {
                test = false;
            }
        } else {
            while (error_pergunta.firstChild) {
                error_pergunta.removeChild(error_pergunta.firstChild)
            }
            form4[3] = false;
        }
        if (resposta.value == "") {
            if (!form4[4]) {
                var br_resposta = document.createElement("br");
                error_resposta.appendChild(
                    document.createTextNode("Digite sua resposta!")
                )
                error_resposta.appendChild(br_resposta);

                form4[4] = true;
                test = false;
            } else {
                test = false;
            }
        } else {
            while (error_resposta.firstChild) {
                error_resposta.removeChild(error_resposta.firstChild)
            }
            form4[4] = false;
        }
        for (let x = 0; x < form4.length; x++) {
            if (form4[x]) {
                val++;
            }
        }
        if (val == 0) {
            var cat_btn = document.getElementsByName("categoria");
            if (cat_btn[1].checked) {
                cat_btn[1].value = 2;
            }
            if (cat_btn[0].checked) {
                cat_btn[0].value = 1;
            }
            test = true;
        }
    }
}

function validarCPF(cpf) {
    var add;
    var rev;

    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf == '') return false;
    // Elimina CPFs invalidos conhecidos
    if (cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999")
        return false;
    // Valida 1o digito
    add = 0;
    for (i = 0; i < 9; i++)
        add += parseInt(cpf.charAt(i)) * (10 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(9)))
        return false;
    // Valida 2o digito
    add = 0;
    for (i = 0; i < 10; i++)
        add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(10)))
        return false;
    return true;
}

function validarEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function validarData(datanascimento) {
    var data = datanascimento;
    data = data.replace(/\//g, "-");

    // comparo as datas e calculo a idade
    var hoje = new Date();
    var nasc = new Date(data);
    var hoje_ano = hoje.getFullYear();
    var nasc_ano = nasc.getFullYear();
    var calc = hoje_ano - nasc_ano;

    if (hoje_ano <= nasc_ano) {
        return false;
    }
    if (calc < 12) {
        return false;
    }

    return true;

}

