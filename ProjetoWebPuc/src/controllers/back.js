//função ao clicar em gravar produto novo//

async function post_product (){

    especification = document.getElementById('product_form'); //*atenção ao adicionar o forms de produto, deve conter este nome "product_form"
    product_data = new FormData(especification);

    var produc_post = await fetch ("backend/potian.php", {
        mehtod: "POST",
        body: product_data

    });

    var result_product = await product_data.json();

    
}


    //função para pegar os dados de login e fazer validação
async function validation() {

    document.getElementById(""/*colocar o id do formulário*/).addEventListener(""/*colocar a função do html de mandar arquivos*/, function (e) { // nessa linha é adicionado uma função de ouvinte quando o formulário é enviado
        e.preventDefault(); //nessa linha o método preventdefault evita que o formulário seja mandado recarregando a página, que é o método default
        let form = e.target; //defino a variável form com let por ser mais apropriada, ela tem escopo de bloco. Depois target funciona para manipulação de eventos e permite que você acesse o elemento específico que desencadeou o evento.
    
        fetch("backend/potian.php", {
            method: "POST",
            body: new FormData(form)
        })/*colocar os 'name's no fomulario html para que o PHP reconheça */

        .then(response => response.text())
        .then(result => {
            document.getElementById("resultado").innerHTML = result;
        }); /*aqui devo fazer a parte de echo da resposta se o login foi bem-sucedido ou não */
    });
    

}



    // função para carrregar os cards
window.onload = async function () {

    var card_load = await fetch ("backend/potian.php", {
        method: "GET"
    })
    .then(response => response.json())
    .then(data => {
        var variavel_js = data.json_card;
        console.log(json_card);
    })
    .catch(error => {
        console.error('Erro ao buscar dados do servidor: ' + error);
    });

    for(var i = 0; i < dados.lenght; i++) {
        var card = `
        <div class="row col-10 mx-auto">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <img src="../../public/img/LOGO.png" class="card-img-top mt-5" alt="...">
            </div>
            <div class="card-content">content</div>${json_card[i].titulo}
            <div class="card-price">prices</div>${json_card[i].valor}
            <button type="button" class="btn mb-3" id="btnshop">ADICIONAR AO CARRINHO</button>
        </div>
    </div>`
        document.getElementById('filmes').innerHTML += template;
    }
}
