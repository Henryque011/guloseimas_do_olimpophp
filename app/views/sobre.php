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
        <?php
        // Inclui  a pagina  sobre banner
        require('pagina_sobre/banner_sobre.php');



        // Inclui  a pagina  sobre mim
        require('pagina_sobre/sobre_mim.php');

        // Inclui  a pagina  quem sou eu
        require('pagina_sobre/quem_sou_eu.php');


        // Inclui  a pagina  minha_historia
        require('pagina_sobre/minha_historia.php');


        // Inclui  a pagina  meus serviços
        require('pagina_sobre/meus_servicos.php');


        // Inclui  a pagina  carrosel_produtos
        require('pagina_sobre/carrosel_produtos.php');


        // Inclui  a pagina  carrosel_produtos
        require('pagina_sobre/especialidades.php');


        ?>



    </main>

    <footer>
        <?php
        // Inclui o cabeçalho
        require('template/footer.php');
        ?>
    </footer>


    </main>


    <?php
    // Inclui o script
    require('script_geral/script.php');
    ?>

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


</body>

</html>