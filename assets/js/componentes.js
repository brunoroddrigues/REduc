import { criarRodape } from "./componente_footer.js";
import { criarHeader } from "./componente_header.js";
// import { criarCard } from "./card.js";
// import { criarCard2 } from "./card2.js";
<<<<<<< HEAD

// $.ajax({
    
// })
=======
>>>>>>> fdd9c24314ef8922d229178fc0f145bfeb9fe32e

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

function criarCards(qtd){
    $.ajax({
        url: "",
        type: "post",
        data: {
            quantidade: qtd
        },
        success: (resposta)=>{
            let cards = JSON.parse(resposta);
            
        }
    })
}

criarRodape()