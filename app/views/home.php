<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php
    // Inclui o head
    require('head_geral/head.php');
    ?>
</head>
<!-- teste --> <!-- teste -->

<body>

    <header>
        <?php
        // Inclui o cabeçalho
        require('template/header.php');
        ?>
    </header>
    <main>
        <?php
        // loader
        require('template/loader.php');

        // Inclui  a pagina ben_vindo
        require('pagina_home/ben_vindo.php');


        // Inclui  a pagina destaque_home.php
        require('pagina_home/destaque_home.php');


        // Inclui  a pagina qualidade_especial_home
        require('pagina_home/qualidade_especial_home.php');

        // Inclui  a pagina sobre_pessoa_home.php
        require('pagina_home/sobre_pessoa_home.php');


        // Inclui  a pagina banner_chocolate_home.php
        require('pagina_home/banner_chocolate_home.php');

        ?>


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


</body>
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



    document.addEventListener("DOMContentLoaded", function() {
        // Textos dinâmicos para o título principal (h2)
        const textosH2 = [
            "Bem-vindo à Guloseimas do Olimpo!",
            "Sabores dos Deuses em cada mordida!",
            "Uma experiência doce como nunca antes!",
            "Transformamos momentos em pura doçura!",
            "Doces artesanais feitos com amor!"
        ];

        // Textos dinâmicos para o subtítulo (h3)
        const textosH3 = [
            "Reserve agora mesmo a nossa deliciosa variedade de doces.",
            "Descubra sabores únicos e irresistíveis!",
            "Sabor e tradição em cada pedacinho.",
            "Os melhores doces, preparados especialmente para você!",
            "Encomende agora e deixe seu dia mais doce!"
        ];

        let index = 0; // Índice para alternar os textos

        function mudarTextos() {
            const tituloH2 = document.querySelector(".guloseimas h2");
            const tituloH3 = document.querySelector(".guloseimas h3");

            if (tituloH2 && tituloH3) {
                tituloH2.textContent = textosH2[index];
                tituloH3.textContent = textosH3[index];

                // Atualiza o índice para o próximo texto
                index = (index + 1) % textosH2.length;
            }
        }

        // Muda os textos a cada 5 segundos
        setInterval(mudarTextos, 5000);
    });
</script>
</body>


</html>