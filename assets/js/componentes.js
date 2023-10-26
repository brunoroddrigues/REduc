import { criarRodape } from "./componente_footer.js";
import { criarHeader } from "./componente_header.js";

$.ajax({
    url: "teste.php",
    type: "post",
    success: (resposta)=>{
        let loginStatus = JSON.parse(resposta);
        criarHeader(loginStatus);
    }
})

criarRodape()