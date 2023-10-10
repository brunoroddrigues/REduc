var toolbarOptions = [
  [{ font: [] }],
  [{ header: [1, 2, 3, 4, 5, 6, false] }],

  ["bold", "italic", "underline", "strike"],
  [{ color: [] }, { background: [] }],

  [{ list: "ordered" }, { list: "bullet" }],
  [{ script: "sub" }, { script: "super" }],
  [{ indent: "-1" }, { indent: "+1" }],

  [{ align: [] }],

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

const form = document.querySelector("#form-recurso")

form.addEventListener("submit", function(event){
    event.preventDefault();
    let conteudo = quill.getContents();
    if(conteudo.ops[0].insert == "\n"){
        alert("Não há conteúdo!\nNão é possível postar documentos em branco!\nPor favor, digite seu recurso");
    } else {
        /* Comando AJAX para enviar ao servidor/conexão PHP com o banco */
    }
})