<section class="ben_vindo">
    <article class="site">
        <div class="lado_a_lado">
            <div class="guloseimas">
                <h2>Bem-vindo à
                    Guloseimas do Olimpo!</h2>

                <h3>Reserve agora mesmo a nossa
                    deliciosa variedade de doces</h3>

                <a href="http://localhost/guloseimas_do_olimpophp/public/galeria">Veja nossa galeria</a>
            </div>
            <div class="lado_a_lado_img">
                <?php foreach ($galeria as $foto): ?>
                    <div class="img_01">
                        <a href="http://localhost/guloseimas_do_olimpophp/public/galeria"><img src="<?php echo BASE_URL . 'uploads/' . $foto['foto_galeria']; ?>" class="ben_vindo_img"
                                alt="<?php echo $foto['alt_foto_galeria']; ?>"></a>
                    </div>
                <?php endforeach; ?>

            </div>

        </div>
    </article>
</section>