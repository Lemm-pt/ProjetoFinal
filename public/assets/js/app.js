// app.js

// ========================================================
function adicionar_pedido(id_product) {

    // adicionar produto à mesa
    axios.defaults.withCredentials = true;
    axios.get('?a=adicionar_pedido&id_product=' + id_product)  // get é o pedido (chamada)
        .then(function (response) {     // então (resposta)
           // console.log(response.data);              
            var total_produtos = response.data;
            document.getElementById('pedidos_mesa').innerText = total_produtos;
            document.getElementById('pedidos_mesa_menu').innerText = total_produtos;
        });
}

// ========================================================
function limpar_mesa() {

    // axios.defaults.withCredentials = true;
    // axios.get('?a=limpar_mesa') 
    //     .then(function (response) {    
    //         document.getElementById('pedidos_mesa').innerText = 0;
    //     });
    


     var e = document.getElementById("confirmar_limpar_mesa");
     e.style.display = "inline"; // na view está display none (oculto) aqui display inline mostra
}

// // ========================================================
// function adicionar_retirar(id_product,quantidade) {

//     axios.defaults.withCredentials = true;
//     axios.get('?a=adicionar_retirar&id_product=' + id_product + '&quantidade=' + quantidade + '&op=' + op)
//         .then(function (response) {
//             if (op == 'adicionar') {
//                 quantidade += 1;
//                 document.getElementById('quantidade').innerText = quantidade;
//                 console.log(response.data);  
//             } else { 
//             document.getElementById('quantidade').innerText = quantidade--;
//            }
//         });
    
// }

// ========================================================
function limpar_mesa_off(){
    var e = document.getElementById("confirmar_limpar_mesa");
    e.style.display = "none";
}

// ========================================================
function usar_morada_alternativa(){
    
    // mostrar ou esconder o espaço para a morada alternativa.
    var e = document.getElementById('check_morada_alternativa');
    if(e.checked == true){
        
        // mostra o quadro para definir morada alternativa
        document.getElementById("morada_alternativa").style.display = 'block';

    } else {
        
        // esconde o quadro para definir morada alternativa
        document.getElementById("morada_alternativa").style.display = 'none';
    }
}

// ========================================================
function morada_alternativa(){
    axios({
        method: 'post',
        url: '?a=morada_alternativa',
        data: {
            text_morada: document.getElementById('text_morada_alternativa').value,
            text_cidade: document.getElementById('text_cidade_alternativa').value,
            text_email: document.getElementById('text_email_alternativo').value,
            text_telefone: document.getElementById('text_telefone_alternativo').value
        }
    });
}