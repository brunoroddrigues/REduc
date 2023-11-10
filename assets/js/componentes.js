import { criarRodape } from "./componente_footer.js";
import { criarHeader } from "./componente_header.js";

// Header login ?
$.ajax({
    url: "Log_status.php",
    type: "post",
    success: (resposta)=>{
        let loginStatus = JSON.parse(resposta);
        
        if (loginStatus.status) {
            let img = loginStatus.img;
            criarHeader(loginStatus.status, loginStatus.img, loginStatus.id_usuario);
            console.log(loginStatus);
        } else {
            criarHeader(loginStatus.status);
        }
        
    }
})

// Cards


// criarCards(4)

criarRodape()