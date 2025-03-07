<!DOCTYPE html>
<html lang="pt-br">



<style>
    .container {
        display: flex;
        flex-direction: column;
        justify-content: end;
        align-items: anchor-center;
    }

    .container p {
        margin-bottom: 50px;
        font-size: 20pt;
        color: #985C41;
    }


    #email {
        border-top: none;
        border-left: none;
        border-right: none;
        border-bottom: 2px solid #985C4150;
        background-color: transparent;
        width: 300px;
        height: 30px;
        color: #985C41;
        font-size: 13pt;
        /* margin-bottom: 30px; */
        margin: 30px 0;
    }

    .email_recuperar::placeholder {
        color: #985C41;

    }

    .nova_senha_forms {
        display: flex;
        flex-direction: column;
    }

    .enviar_senha {
        background-color: #9BE79E;
        letter-spacing: 3px;
        font-weight: 600;
        color: white;
        border: none;
        /* height: 50px; */
        width: 300px;
        height: 30px;
        font-size: 13pt;
        /* margin-bottom: 30px; */
        margin: 30px 0;
        height: 50px;
        border-radius: 10px;
        font-size: 20pt;
    }



    input:focus {
        outline: none;
        /* Remove a borda de foco padrão */

    }
</style>


<head>

    <?php
    // Inclui o head
    require('head_geral/head.php');
    ?>

</head>

<header>
    <?php
    // loader
    require('template/loader.php');

    // Inclui o cabeçalho
    require('template/header.php');
    ?>
</header>


<body>


    <main>


        <section class="banner_contato" style="background-image: url('<?php echo BASE_URL . 'uploads/' . $banner[0]['foto_banner']; ?>');">
            <article class="site">
                <div>
                    <h2>Recuperar senha </h2>
                </div>
            </article>
        </section>


        <section class="brigadeiros">
            <article class="site">
                <div>
                    <h2>Recuperar senha</h2>
                </div>

                <div>
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/BRIGADEIRO 2.svg" alt="brigadeiros">
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/BRIGADEIRO 3.svg" alt="brigadeiros">
                </div>
            </article>
        </section>



        <section class="login_contato">
            <article class="site">
                <div class=" lado_a_lado">



                    <div class="container">

                        <p>Digite seu e-mail cadastrado para receber uma nova senha.</p>

                        <?php if (!empty($mensagem)) : ?>
                            <p class="mensagem"><?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?></p>
                        <?php endif; ?>

                        <form class="nova_senha_forms" action="<?= BASE_URL ?>Recuperarsenha/enviarEmail" method="POST">
                            <label for="email"></label>
                            <input class="email_recuperar" type="email" name="email" id="email" required placeholder='E-mail:'>

                            <div class="button_forms">
                                <button class="enviar_senha" type="submit">Enviar nova senha</button>
                            </div>
                        </form>

                        <a href="<?= BASE_URL ?>entrar">Voltar ao Login</a>
                    </div>
                </div>
            </article>
        </section>


        <section class="brigadeiros">
            <article class="site">
                <div>

                </div>

                <div>
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/BRIGADEIRO 4.svg" alt="brigadeiros">
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/BRIGADEIRO 5.svg" alt="brigadeiros">
                </div>
            </article>
        </section>


        <!-- Modal do Bootstrap -->
        <!-- Modal do Bootstrap -->

        <div class="modal fade" id="mensagemModal" tabindex="-1" aria-labelledby="mensagemModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mensagemModalLabel">Aviso 📢</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                    🎉 Tudo certo! Acabamos de enviar um e-mail com sua nova senha. Se não encontrar na caixa de entrada, dá uma olhadinha no spam! 📩
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
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
    document.addEventListener("DOMContentLoaded", function () {
        var form = document.querySelector(".nova_senha_forms"); // Seleciona o formulário
        var botaoEnviar = document.querySelector(".enviar_senha"); // Botão de envio
        var modal = new bootstrap.Modal(document.getElementById("mensagemModal")); // Referência ao modal

        if (form && botaoEnviar) {
            form.addEventListener("submit", function (event) {
                event.preventDefault(); // Impede o envio imediato do formulário
                
                modal.show(); // Exibe o modal imediatamente

                setTimeout(function () {
                    form.submit(); // Envia o formulário após 3 segundos
                }, 3000);
            });
        }
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