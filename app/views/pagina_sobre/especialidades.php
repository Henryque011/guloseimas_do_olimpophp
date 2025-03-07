<section class="especialidades">
            <article class="site">
                <div>
                    <h3>ESPECIALIDADES</h3>
                </div>
                <div class="lado_a_lado">
                <?php foreach ($servicos as $servicos_sobre): ?>
                    <?php if ($servicos_sobre['status_servico'] === 'Ativo'): ?> <!-- Verifica se o produto está ativo -->
                    <div class="especialidade_produto">
                        <div class="pd">
                            <img src="<?php echo BASE_URL . 'uploads/' . $servicos_sobre['foto_servico']; ?>" alt="<?php echo htmlspecialchars($servicos_sobre['alt_foto_servico']); ?>">

                            <div class="especialidade_informacoes">
                                <h4><?php echo $servicos_sobre['nome_servico']; ?></h4>
                                <p><?php echo $servicos_sobre['descricao_servico']; ?></p>
                            </div>
                        </div>

                    </div>
                    <?php endif; ?>

                    <?php endforeach; ?>
                </div>
            </article>
        </section>