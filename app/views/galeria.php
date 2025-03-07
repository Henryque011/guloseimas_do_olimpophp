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
        <!-- Seção do banner -->
        <section class="banner_galeria" style="background-image: url('<?php echo BASE_URL . 'uploads/' . $banner[0]['foto_banner']; ?>');">
            <article class="site">
                <div>
                    <h2>Galeria</h2>
                </div>
            </article>
        </section>

        <!-- Seção da galeria de fotos -->
        <section class="fotos_galeria">
            <article class="site">
                <div class="lado_a_lado_galeria">
                    <?php foreach ($pg_galeria as $galeria_pg): ?>
                        <?php if ($galeria_pg['status_galeria'] === 'Ativo'): ?>
                            <div class="galeria_pd">
                                <a href="#">
                                    <img src="<?php echo BASE_URL . 'uploads/' . $galeria_pg['foto_galeria']; ?>" alt="<?php echo htmlspecialchars($galeria_pg['alt_foto_galeria'], ENT_QUOTES, 'UTF-8'); ?>" class="img_pg_galeria">
                                </a>
                                <h3><?php echo htmlspecialchars($galeria_pg['nome_galeria'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </article>
        </section>
    </main>

    <footer>
        <?php
        // Inclui o rodapé
        require('template/footer.php');
        ?>
    </footer>

    <?php
    // Inclui os scripts gerais
    require('script_geral/script.php');
    ?>
</body>
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