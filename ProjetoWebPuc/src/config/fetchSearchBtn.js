async function pesquisa(){
   
    document.querySelector('#btn').addEventListener('click', async function(e) {
        e.preventDefault();
        var search = document.querySelector('input[name="search"]').value;
        var response = await fetch("backend/potian.php", {
            method: "POST",
            body: "search=" + search
        });
        if (response.ok) {
            var results = await response.json();
            // testar que o homem não é de ferro
            console.log(results);
        }

           // muito teoricamente isso vai exibir na tela só os produtos q correspondem ao q está escrito na barra
           var resultsContainer = await results;
           resultsContainer.innerHTML = ''; // Limpa os resultados antigos
           results.forEach(function(result) {
               var card = document.createElement('div');
               card.innerHTML = `
                   <div class="card" style="width: 18rem;">
                       <div class="card-body">
                           <img src="${result.imagem}" class="card-img-top mt-5 mx-auto" alt="...">
                       </div>
                       <div class="card-content">${result.content}</div>
                       <div class="card-price">${result.price}</div>
                       <form>
                           <button type="button" class="btn mb-3 mx-auto" id="btnshop">ADICIONAR AO CARRINHO</button>
                       </form>
                   </div>
               `;
               resultsContainer.appendChild(card);
           });
    });
}