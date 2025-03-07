<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php
    // Inclui o head
    require('head_geral/head.php');
    ?>
</head>

<body>
    <header>
        <?php
        // loader
        require('template/loader.php');

        // Inclui o cabeçalho
        require('template/header.php');
        ?>
    </header>

    <main>

        <section class="banner_produtos" style="background-image: url('<?php echo BASE_URL . 'uploads/' . $banner_produto[0]['foto_banner']; ?>');">
            <article class="site">
                <div>
                    <h2>Encomende seu produto</h2>
                </div>
            </article>
        </section>

        <section class="produtos">
            <article class="site">
                <div class="lado_a_lado">

                    <div class="filtro-de-preco">
                        <ul>
                            <div>
                                <h4>Filtrar por preço</h4>
                            </div>
                            <div>
                                <input type="range" min="0" max="100" value="50" class="escolher-valor" id="escolher-valor">
                                <p>Preço: R$ <span id="preco-atual">0</span></p>
                                <h3>Filtrar por categoria</h3>

                                <div class="lado_a_lado_lista">
                                    <?php if (isset($categorias) && is_array($categorias)): ?>
                                        <?php foreach ($categorias as $categoria): ?>
                                            <li class="categoria-item" data-categoria="<?php echo htmlspecialchars($categoria['id_categoria'], ENT_QUOTES, 'UTF-8'); ?>">
                                                <p><?php echo htmlspecialchars($categoria['nome_categoria'], ENT_QUOTES, 'UTF-8'); ?></p>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <li>
                                            <p>Nenhuma categoria disponível</p>
                                        </li>
                                    <?php endif; ?>
                                </div>
                                <div class="lado_a_lado_lista">
                                    <li id="verTodosProdutos" class="categoria-item">
                                        <p>Ver todos os produtos</p>
                                    </li>
                                </div>
                            </div>
                        </ul>
                    </div>

                    <div class="wrap" id="produtos">
                        <?php foreach ($pg_produtos as $PG_produtos): ?>
                            <?php if ($PG_produtos['status_pedido'] === 'Ativo'): ?>
                                <div class="tamanho_link">
                                    <a href="<?php echo BASE_URL . 'produtos/detalhe/' . $PG_produtos['link_produto']; ?>" class="produtos_link_a">
                                        <div class="produto_a_mostra">
                                            <img src="<?php echo BASE_URL . 'uploads/' . $PG_produtos['foto_produto']; ?>"
                                                alt="<?php echo htmlspecialchars($PG_produtos['alt_foto_produto'], ENT_QUOTES, 'UTF-8'); ?>"
                                                class="pg_produto">
                                        </div>
                                        <div class="preco_produto">
                                            <h3><?php echo htmlspecialchars($PG_produtos['nome_produto'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                            <p>R$ <?php echo number_format($PG_produtos['preco_produto'], 2, ',', '.'); ?></p>
                                            <button class="adicionar-favorito" data-id-produto="<?php echo $PG_produtos['id_produto']; ?>">
                                                <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/adicionar_favoritos.svg" alt="adicionar_favoritos">
                                            </button>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                </div>
            </article>
        </section>

        <section class="ver_mais">
            <article class="site">
                <div>
                    <button id="verMaisBtn">
                        <h3>Ver mais produtos</h3>
                    </button>
                </div>
            </article>
        </section>

    </main>

    <footer>
        <?php
        // Inclui o cabeçalho
        require('template/footer.php');
        ?>
    </footer>

    <?php
    // Inclui o script
    require('script_geral/script.php');
    ?>

    <!-- Modal de "Todos os produtos carregados" -->
    <div class="modal fade" id="modal_produtos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Status Produtos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Todos os produtos foram carregados! <!-- Aqui pode ajustar o texto conforme o caso -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal de "Produto Adicionado aos Favoritos" -->
    <!-- Modal de "Produto Adicionado aos Favoritos" -->
    <div class="modal fade" id="modal_adicionado_favorito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Produto Adicionado aos Favoritos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    O produto foi adicionado à sua lista de favoritos com sucesso!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


<!-- Modal de Login Necessário -->
<!-- Modal de Login -->
<div class="modal fade" id="modal_fazer_login" tabindex="-1" aria-labelledby="modal_fazer_loginLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_fazer_loginLabel">Login Necessário</h5>
               
            </div>
            <div class="modal-body">
                <p>Você precisa estar logado para adicionar produtos aos favoritos. Clique no botão abaixo para fazer login.</p>
            </div>
            <div class="modal-footer">
                <a href="<?php echo BASE_URL; ?>login" class="btn btn-primary">Fazer Login</a>
               
            </div>
        </div>
    </div>
</div>

</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const produtosContainer = document.getElementById("produtos");
        const btnVerMais = document.getElementById("verMaisBtn");
        const precoRange = document.getElementById("escolher-valor");
        const precoAtual = document.getElementById("preco-atual");
        const categoriaItems = document.querySelectorAll(".categoria-item");
        const btnVerTodosProdutos = document.getElementById("verTodosProdutos");

        /**
         * Função para carregar mais produtos ao clicar no botão "Ver mais"
         */


        // Função para carregar mais produtos
        let produtosIniciais = 0; // Agora o offset começa com 16
        let offset = produtosIniciais;
        const limite = 2; // Define quantos produtos carregar por clique

        function carregarMaisProdutos() {
            fetch(`<?php echo BASE_URL; ?>produtos/carregarMaisProdutos?offset=${offset}&limite=${limite}`)
                .then(response => response.text())
                .then(data => {
                    let cleanedData = data.trim(); // Remove espaços extras

                    if (cleanedData === "") {
                        btnVerMais.style.display = "none"; // Esconde o botão se não houver mais produtos
                        const modal = new bootstrap.Modal(document.getElementById('modal_produtos'));
                        modal.show();
                    } else {
                        produtosContainer.innerHTML += cleanedData; // Adiciona os novos produtos
                        offset += limite; // 🔥 Atualiza corretamente o offset

                        // 🔥 REATRIBUIR EVENTOS AOS NOVOS BOTÕES DE FAVORITOS
                        reatribuirEventosFavoritos();
                    }
                })
                .catch(error => console.error("Erro ao carregar mais produtos:", error));
        }

        // 🔥 Função para reatribuir eventos aos botões de favoritos nos produtos carregados dinamicamente
        function reatribuirEventosFavoritos() {
            document.querySelectorAll(".adicionar-favorito").forEach(botao => {
                botao.removeEventListener("click", adicionarAosFavoritos); // Remove eventos anteriores
                botao.addEventListener("click", adicionarAosFavoritos); // Adiciona novamente o evento
            });
        }

        /**
         * Função para filtrar produtos por categoria
         */
        function filtrarPorCategoria(categoriaId) {
            btnVerMais.style.display = "none"; // Esconde o botão "Ver mais produtos"

            fetch(`<?php echo BASE_URL; ?>produtos/filtrarPorCategoria?categoria=${categoriaId}&offset=0&limite=100`)
                .then(response => response.text())
                .then(data => {
                    let cleanedData = data.trim(); // Remove espaços extras

                    if (cleanedData === "") {
                        produtosContainer.innerHTML = "<p class='sem-produtos'>Nenhum produto encontrado para esta categoria.</p>";
                    } else {
                        produtosContainer.innerHTML = cleanedData; // Limpa e exibe apenas os produtos filtrados
                        reatribuirEventosFavoritos(); // 🔥 REATRIBUIR EVENTOS AOS NOVOS BOTÕES
                    }
                })
                .catch(error => console.error("Erro ao filtrar produtos:", error));
        }

        function reatribuirEventosFavoritos() {
            document.querySelectorAll('.adicionar-favorito').forEach(button => {
                button.removeEventListener('click', adicionarAosFavoritos); // Remove event listener duplicado
                button.addEventListener('click', adicionarAosFavoritos);
            });
        }

        function adicionarAosFavoritos(event) {
    event.preventDefault();
    const idProduto = event.target.closest(".adicionar-favorito").getAttribute("data-id-produto");

    fetch('<?php echo BASE_URL; ?>favoritos/adicionarFavorito', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id_produto: idProduto })
    })
    .then(response => response.json())
    .then(data => {
        if (data.sucesso) {
            // Exibe o modal de sucesso ao adicionar o produto aos favoritos
            const modalFavorito = new bootstrap.Modal(document.getElementById('modal_adicionado_favorito'));
            modalFavorito.show();
        } else if (data.redirect) {
            // Exibe o modal de login caso o usuário não esteja autenticado
            const modalLogin = new bootstrap.Modal(document.getElementById('modal_fazer_login'));
            modalLogin.show();
        } else {
            // Não exibe nenhum alerta aqui
            // Caso não tenha ocorrido erro, mas o favorito não foi adicionado, não é necessário fazer nada
        }
    })
   
}

// Event Listener para os botões
document.addEventListener("click", function(event) {
    if (event.target.closest(".adicionar-favorito")) {
        event.preventDefault();
        adicionarAosFavoritos(event);
    }
});




        /**
         * Função para filtrar produtos por preço
         */
        function filtrarPorPreco(precoMaximo) {
            precoAtual.textContent = precoMaximo; // Atualiza o texto do preço selecionado

            fetch(`<?php echo BASE_URL; ?>produtos/filtrarPorPreco?preco=${precoMaximo}`)
                .then(response => response.text())
                .then(data => {
                    let cleanedData = data.trim(); // Remove espaços extras

                    if (cleanedData === "") {
                        produtosContainer.innerHTML = "<p class='sem-produtos'>Nenhum produto encontrado dentro desse preço.</p>";
                    } else {
                        produtosContainer.innerHTML = cleanedData; // Substitui os produtos com os filtrados
                        reatribuirEventosFavoritos(); // 🔥 REATRIBUIR EVENTOS AOS NOVOS BOTÕES
                    }
                })
                .catch(error => console.error("Erro ao filtrar por preço:", error));
        }

        /**
         * Função para exibir todos os produtos novamente
         */
        function mostrarTodosProdutos() {
            fetch(`<?php echo BASE_URL; ?>produtos/mostrarTodosProdutos?offset=0&limite=100`)
                .then(response => response.text())
                .then(data => {
                    let cleanedData = data.trim();

                    if (cleanedData === "") {
                        produtosContainer.innerHTML = "<p class='sem-produtos'>Nenhum produto encontrado.</p>";
                    } else {
                        produtosContainer.innerHTML = cleanedData;
                        btnVerMais.style.display = "block";
                        reatribuirEventosFavoritos(); // 🔥 REATRIBUIR EVENTOS AOS NOVOS BOTÕES
                    }
                })
                .catch(error => console.error("Erro ao carregar todos os produtos:", error));
        }


        // Eventos
        if (btnVerMais) {
            btnVerMais.addEventListener("click", carregarMaisProdutos);
        }

        if (precoRange) {
            precoRange.addEventListener("input", function() {
                filtrarPorPreco(this.value);
            });
        }

        categoriaItems.forEach(item => {
            item.addEventListener("click", function() {
                const categoriaId = this.dataset.categoria;
                filtrarPorCategoria(categoriaId);
            });
        });

        if (btnVerTodosProdutos) {
            btnVerTodosProdutos.addEventListener("click", mostrarTodosProdutos);
        }



        document.querySelectorAll('.adicionar-favorito').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                const idProduto = this.getAttribute('data-id-produto');
                console.log(idProduto); // Verifique se está retornando o ID correto do produto

                fetch('<?php echo BASE_URL; ?>favoritos/adicionarFavorito', {
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
                    .catch(error => {
                        console.error("Erro ao adicionar o produto aos favoritos:", error);
                       
                    });
            });
        });




    });
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {
    let links = document.querySelectorAll(".nav-link");
    let currentUrl = window.location.href;

    links.forEach(link => {
        if (link.href === currentUrl) {
            link.classList.add("ativo");
        }
    });
});
</script>
</body>


</html>