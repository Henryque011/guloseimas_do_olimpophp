<?php

$erroLogin = isset($_SESSION['login-erro']) ? $_SESSION['login-erro'] : null;
unset($_SESSION['login-erro']); // Limpa a sessão para não mostrar sempre
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php
    // Inclui o head
    require('head_geral/head.php');
    ?>
</head>

<style>
    input[type="email"],
    input[type="password"] {
        text-transform: normal !important;
    }

    input[type="password"] {
        text-transform: normal !important;
    }

    #senha_entrar {
        text-transform: normal !important;
    }
</style>

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
        <!-- Banner -->
        <section class="banner_contato" style="background-image: url('<?php echo BASE_URL . 'uploads/' . $banner[0]['foto_banner']; ?>');">
            <article class="site">
                <div>
                    <h2>Entrar</h2>
                </div>
            </article>
        </section>

        <!-- Informações adicionais -->
        <section class="brigadeiros">
            <article class="site">
                <div>
                    <h2>Entrar</h2>
                </div>

                <div>
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/BRIGADEIRO 2.svg" alt="brigadeiros">
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/BRIGADEIRO 3.svg" alt="brigadeiros">
                </div>
            </article>
        </section>

        <!-- Formulário de Login -->
        <section class="login_contato">
            <article class="site">
                <div class="lado_a_lado">
                    <div class="forms_contato">
                        <form method="POST" action="http://localhost/guloseimas_do_olimpophp/public/entrar/entrar">
                            <div class="nome_entrar">
                                <div class="email_entrar">
                                    <div class="entrar_email">
                                        <label for="email"></label>
                                        <!-- Preenche o campo de email com o valor armazenado na sessão -->
                                        <input type="email" name="email_entrar" id="email_entrar" placeholder="Endereço de email" required>
                                    </div>

                                    <label for="senha"></label>
                                    <div style="position: relative; display: flex; align-items: center;">
                                        <input type="password" id="senha_entrar" name="senha_entrar" required placeholder="Senha" style="text-transform: none; padding-right: 40px;">
                                        <button type="button" id="toggleSenha" style="position: absolute; right: 10px; background: none; border: none; cursor: pointer;">
                                            🙈
                                        </button>
                                    </div>
                                    
                                </div>

                                <div class="lembrar">
                                    <a href="http://localhost/guloseimas_do_olimpophp/public/Recuperarsenha/">Esqueceu a senha?</a>
                                    <div class="checkbox">
                                        <input type="checkbox" id="lembrar" name="lembrar">
                                        <label for="lembrar">
                                            <p>lembrar email/senha</p>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="button_forms">
                                <button type="submit">Entrar</button>
                            </div>

                            <!-- Modal de Erro -->

                        </form>
                    </div>
                </div>
            </article>
        </section>

        <!-- Imagens adicionais -->
        <section class="brigadeiros">
            <article class="site">
                <div></div>
                <div>
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/BRIGADEIRO 4.svg" alt="brigadeiros">
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/BRIGADEIRO 5.svg" alt="brigadeiros">
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


    <!-- Modal de Erro -->
    <div class="modal fade" id="modalErro" tabindex="-1" aria-labelledby="modalErroLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalErroLabel">Erro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="mensagemErro"><?php echo $erroLogin ?? ''; ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>



</body>

<script>
    document.getElementById('toggleSenha').addEventListener('click', function() {
        let inputSenha = document.getElementById('senha_entrar');
        if (inputSenha.type === 'password') {
            inputSenha.type = 'text';
            this.textContent = '👁️'; // Ícone para mostrar a senha
        } else {
            inputSenha.type = 'password';
            this.textContent = '🙈'; // Ícone para esconder a senha
        }
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        let erroLogin = "<?php echo $erroLogin; ?>";
        if (erroLogin) {
            let modalErro = new bootstrap.Modal(document.getElementById('modalErro'));
            modalErro.show();
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