document.addEventListener('click', function(event) {
    // Garante que o clique foi em um botão "adicionar-favorito"
    if (event.target.closest('.adicionar-favorito')) {
        event.preventDefault();
        
        const button = event.target.closest('.adicionar-favorito');
        const idProduto = button.getAttribute('data-id-produto');

        console.log("Adicionando produto ID:", idProduto); // Teste no console

        fetch(BASE_URL + 'favoritos/adicionarFavorito', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id_produto: idProduto
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.sucesso) {
                // Exibe o modal de sucesso
                const modal = new bootstrap.Modal(document.getElementById('modal_adicionado_favorito'));
                modal.show();
            } else {
               
            }
        })
       
    }
});
