<style>
    .qualidade_especial .site .alta_qualidade {
        background-image: url('<?php echo BASE_URL . 'uploads/' . htmlspecialchars($qualidade['foto_galeria'], ENT_QUOTES, 'UTF-8'); ?>');
        background-size: cover; /* Faz a imagem cobrir todo o fundo */
        width: 400px;
        height: 420px;
        background-repeat: no-repeat; /* Evita que a imagem se repita */
    }
</style>

<section class="qualidade_especial">
            <article class="site">
                <div class="lado_a_lado">
                    <div class="alta_qualidade">
                        <div class="verde">
                            <p>Experimente nosso brigadeiro de alta qualidade, feito com ingredientes selecionados e
                                todo o
                                carinho que você merece!</p>
                        </div>
                    </div>

                    <div class="encomenda">
                        <h2>Qualidade especial</h2>
                        <h3>Encomende uma caixa de presente especial para impressionar seu amigo! Nossas caixas são
                            cuidadosamente elaboradas, repletas de delícias que certamente encantarão e surpreenderão.
                        </h3>
                        <p>Apresentamos a seguir alguns dos nossos principais produtos, cuidadosamente elaborados para
                            encantar seu paladar</p>

                        <div class="hr_doces">
                            <h4>01. <strong>Trufa</strong></h4>
                            <hr>
                            <h4>02. Brownie<strong></strong></h4>
                        </div>
                    </div>
                </div>
            </article>
        </section>