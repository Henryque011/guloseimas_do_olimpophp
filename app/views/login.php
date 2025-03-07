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

        <section class="banner_contato" style="background-image: url('<?php echo BASE_URL . 'uploads/' . $banner[0]['foto_banner']; ?>');">
            <article class="site">
                <div>
                    <h2>Login</h2>
                </div>
            </article>
        </section>


        <section class="brigadeiros">
            <article class="site">
                <div>
                    <h2>Entrar ou criar conta</h2>
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



                    <div class="forms_contato">
                        <form method="POST" action="http://localhost/guloseimas_do_olimpophp/public/login/login">
                            <div style="display: flex; align-items: center; justify-content: center;" class="email">
                                <label for="email">
                                    <img class="email_svg" src="http://localhost/guloseimas_do_olimpophp/public/assets/img/email_forms.svg"
                                        alt="telefone"></label>
                                <input type="email" name="email" id="email" placeholder="Endereço de email" required>
                            </div>

                            <!--   <div class="tipo_usuario">
                                <label for="tipo_usuario">Tipo de Usuário:</label>
                               <select name="tipo_usuario" id="tipo_usuario" required>
                                <option value="Selecione" disabled selected>Selecione</option>

                                    <option value="Funcionario">Funcionário</option>
                                    Outros tipos de usuários, se necessário 
                                </select> 
                            </div> -->

                            <div class="button_forms">
                                <button type="submit">CONTINUAR</button>
                            </div>
                        </form>



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


</body>

</html>