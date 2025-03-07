<section class="carrosel_produtos">
    <article class="site">
        <div>
            <h3>BOLOS</h3>
        </div>
        <section>

            <div class="produtos_carrosel">
            <?php foreach ($galeria_sobre as $sobre_galeria): ?>
                <?php if ($sobre_galeria['status_galeria'] === 'Ativo'): ?> <!-- Verifica se o produto está ativo -->
                    <div>
                        <img src="<?php echo BASE_URL . 'uploads/' .  $sobre_galeria['foto_galeria']; ?>" alt="img">
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>

            </div>
        </section>
    </article>
</section>