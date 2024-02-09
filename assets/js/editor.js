var toolbarOptions = [
    [{font: []}],
    [{header: [1, 2, 3, 4, 5, 6, false]}],

    ["bold", "italic", "underline", "strike"],
    [{color: []}, {background: []}],

    [{list: "ordered"}, {list: "bullet"}],
    [{script: "sub"}, {script: "super"}],
    [{indent: "-1"}, {indent: "+1"}],

    [{align: []}],

    ["image", "link", "video"],

    ["blockquote"],
    ["clean"],
];

var quill = new Quill("#editor", {
    modules: {
        toolbar: toolbarOptions,
    },
    theme: "snow",
});

// const form = document.querySelector("#form-recurso");

// form.addEventListener("submit", function (event) {
//   let conteudo = quill.getContents();
//   if (conteudo.ops[0].insert == "\n") {
//     alert("Não há conteúdo!\nNão é possível postar documentos em branco!\nPor favor, digite seu documento.");
//     event.preventDefault();
//   } else {
//     /* Comando AJAX para enviar ao servidor/conexão PHP com o banco */
//     let dados = JSON.stringify(conteudo);
//     $.ajax({
//       url: "teste.php",
//       type: "POST",
//       data: { data: dados },
//       success: function () {
//         alert("Dados enviados.\nNossos administradores avaliarão o recurso para conferir se ele está de acordo com nossas diretrizes.\nRetornaremos o resultado da avaliação.\nMuito obrigado por ajudar na criação de conteúdo educacional.");
//       },
//       error: function () {
//         alert("Ocorreu um erro inesperado e o recurso não pode ser enviado!\nVocê pode salvar localmente e tentar novamente mais tarde.");
//       },
//     });
//   }
// });

// const download = document.getElementById("download-recurso");

// download.addEventListener("click", function(){
//   let conteudo = quill.getContents();
//   if (conteudo.ops[0].insert == "\n"){
//     alert("Não há conteúdo!\nNão é impossível realizar downloads de documentos em branco!\nPor favor, digite seu documento.");
//   } else {
//     download.href = "data:text/plain;charset=utf-8," + encodeURI(conteudo.ops[0].insert);
//     download.download = "documento.txt";
//   }
// })

function salvar() {
    var recurso = quill.root.innerHTML;

    html2pdf().from(recurso).set().outputPdf();
}