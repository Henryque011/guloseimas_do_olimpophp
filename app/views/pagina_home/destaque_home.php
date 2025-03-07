<section class="destaques">
    <section class="site">
        <div>
            <div class="title">
                <h2>Mais pedidos</h2>
            </div>
            <div class="subtitle">
                Destaques do momento
            </div>
        </div>
        <div class="highlights">
            <?php foreach ($destaque as $item) { ?>
                <div>

                    <div class="box">
                        <div class="img_01">
                            <a href="<?php echo BASE_URL . 'produtos/detalhe/' . $item['link_produto'];?>"><img
                                    src="<?php echo BASE_URL . 'uploads/' . $item['foto_produto']; ?>"
                                    alt="<?php echo $item['alt_foto_produto']; ?>" class="destaque_img"></a>
                        </div>
                        <div>
                            <h3><?php echo htmlspecialchars($item['nome_produto'], ENT_QUOTES, 'UTF-8'); ?>
                            </h3>
                        </div>
                        <div>
                            <p>R$ <?php echo number_format($item['preco_produto'], 2, ',', '.'); ?></p>
                        </div>
                    </div>

                </div>
            <?php } ?>

        </div>
        <div class="space"></div>
    </section>
</section>