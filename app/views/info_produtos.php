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
    <div class="space">

    </div>
    <main>
        <section class="reserva_produto">
            <article class="site">
                <div class="lado_a_lado">
                    <div>
                        <a href="http://localhost/guloseimas_do_olimpophp/public/produtos"><img src="<?php echo BASE_URL . 'uploads/' . $detalheServico['foto_produto']; ?>" alt="<?php echo htmlspecialchars($detalheServico['info_alt_foto_produto']); ?>" class="img_info"></a>
                    </div>
                    <div class="inf_produto">
                        <div class="reserva_title">
                            <h3><?php echo htmlspecialchars($detalheServico['nome_info_produtos'], ENT_QUOTES, 'UTF-8'); ?></h3>

                            <div class="reserva_preco">
                                <p>R$ <?php echo number_format($detalheServico['preco_produto'], 2, ',', '.'); ?></p>
                            </div>
                        </div>

                        <div class="reseva_personalizao">
                            <div class="inf_txt">
                                <p>O valor é equivalente a <span class="pers">personalização</span> </p>
                                <p style="margin-top: 20px;">Produto <?php echo htmlspecialchars($detalheServico['personalizacao_info_produtos'], ENT_QUOTES, 'UTF-8'); ?> </p>
                            </div>
                            <!-- <div class="tipos_personalizacoes">
                                <button></button>
                                <button></button>
                                <button></button>
                            </div>
                        </div>

                        <div class="reserva_preco">
                            <p>R$35</p>
                            <p>Quantidade em estoque  <?php echo number_format($detalheServico['qtd_info_produto'],); ?> </p>
                        </div> -->

                            <div class="reserva_acoes">
                                <!-- <div class="qtd_produto">
                                <div class="number">
                                    <p id="number-display">1</p>
                                </div>
                                <div class="arrows">
                                    <button id="increment-button"><i class="fa-solid fa-arrow-up"></i> </button>
                                    <button id="decrement-button"><i class="fa-solid fa-arrow-down"></i></button>
                                </div>
                            </div> -->
                                <div class="carrinho_produto">
                                    <div class="car">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </div>
                                    <div>
                                        <a href="<?php echo BASE_URL . 'info_produtos/adicionarReserva/' . $detalheServico['id_produto']; ?>">
                                            <p>RESERVE AGORA</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="fav_produto">
                                    <div>
                                        <i id="heart-icon" class="fa-solid fa-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="inf_txt">
                            <p>Todas as reservas são feitas excluisavamente pelo</p>
                            <p class="wtz">WHATSAPP</p>
                        </div>
                        <div class="space">

                        </div>
                    </div>
                </div>
            </article>
        </section>

        <section class="descricao_produto">
            <article class="site">
                <div class="desc">
                    <h3>DESCRIÇÃO</h3>
                    <p><?php echo htmlspecialchars($detalheServico['descricao_info_produto'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <hr>

                </div>
                <div class="space">

                </div>
                <div class="desc">
                    <h3>FORMAS DE PAGAMENTO</h3>
                    <p><?php echo htmlspecialchars($detalheServico['forma_pagamento_info_produto'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <hr>

                </div>
                <div class="space">

                </div>
                <div class="desc">
                    <h3>ENTREGA</h3>
                    <p><?php echo htmlspecialchars($detalheServico['entrega_info_produtos'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <hr>

                </div>
                <div class="space">

                </div>
                <div class="desc">
                    <h3>RESERVAS</h3>
                    <p>Realizamos nossas reservas excluisavamente pelo <span class="pers">Whatsapp</span></p>
                    <p><?php echo htmlspecialchars($detalheServico['reserva_info_produtos'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <hr>

                </div>
                <div class="space">

                </div>
            </article>
        </section>


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

</body>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const heartIcon = document.getElementById("heart-icon");

        if (heartIcon) {
            heartIcon.addEventListener("click", function(event) {
                event.preventDefault();

                const idProduto = '<?php echo $detalheServico['id_produto']; ?>';
                console.log("ID do produto a ser adicionado aos favoritos:", idProduto);

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
                            const modalFavorito = new bootstrap.Modal(document.getElementById('modal_adicionado_favorito'));
                            modalFavorito.show();
                        } else if (data.redirect) {
                            // Se o backend indicar que o usuário não está autenticado, exibe o modal de login
                            const modalLogin = new bootstrap.Modal(document.getElementById('modal_fazer_login'));
                            modalLogin.show();
                        } else {
                            console.log("Nenhuma ação necessária.");
                        }
                    })
                    .catch(error => {
                        console.error("Erro ao adicionar o produto aos favoritos:", error);
                    });
            });
        }
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
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