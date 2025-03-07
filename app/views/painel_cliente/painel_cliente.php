<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php
    // Inclui o head

    require(__DIR__ . '/../head_geral/head.php');
    ?>

</head>

<body>



    <header>


        <?php
   // Inclui o cabeçalho
        require(__DIR__ . '/../template/header.php')
        ?>
    </header>


    <main>


        <section>
            <article class="site">
                <div class="perfils_lado_a_lado">


                    <div class="perfil_cliente">
                        <div class="perfil_editar">
                            <h2>Perfil</h2>
                            <a href="http://localhost/guloseimas_do_olimpophp/public/Cliente/editar_cliente/">Editar</a>
                        </div>

                        <div class="perfil_informaçoes">

                            <div class="informacoes">
                                <h3>Nome</h3>
                                <p><?php echo htmlspecialchars($dados['nome']); ?></p>
                            </div>




                            <div class="informacoes">
                                <h3>CPF</h3>
                                <p><?php echo htmlspecialchars($dados['cpf']); ?></p>
                            </div>

                            <div class="informacoes">
                                <h3>E-mail</h3>
                                <p><?php echo htmlspecialchars($dados['email']); ?></p>
                            </div>

                            <div class="informacoes">
                                <h3>Telefone</h3>
                                <p><?php echo htmlspecialchars($dados['telefone']); ?></p>
                            </div>

                            <div class="informacoes_sair">

                                <a href="http://localhost/guloseimas_do_olimpophp/public/login/sair">Sair</a>
                            </div>
                            <div class="informacoes">
                                <h4>-------------------------------------------------------------------</h4>
                            </div>

                            <div class="perfil_editar">
                                <h2>Senha</h2>
                                <a href="http://localhost/guloseimas_do_olimpophp/public/Cliente/editar_senha_cliente/">Editar</a>
                            </div>

                            <div class="informacoes">

                                <h3>Senha</h3>
                                <p><?php echo str_repeat('*', strlen($dados['senha'])); ?></p>
                            </div>



                        </div>





                    </div>

                    <div class="perfil_favoritos_reservas">


                        <div class="perfil_favoritos">
                            <div class="perfil_produtos_favortios">
                                <h2>Favoritos</h2>
                            </div>

                            <?php if (isset($favoritos) && !empty($favoritos)): ?>
                                <h3>Seus Produtos Favoritos:</h3>
                                <ul>
                                    <?php foreach ($favoritos as $favorito): ?>
                                        <div class="favorito-item">
                                            <!-- Envolvendo todo o item com o link para a página de detalhes -->
                                            <a  class="link_favorito" href="<?php echo BASE_URL . 'produtos/detalhe/' . $favorito['link_produto']; ?>">
                                                <img src="<?php echo BASE_URL . 'uploads/' . $favorito['foto_produto']; ?>" alt="<?php echo htmlspecialchars($favorito['alt_foto_produto'], ENT_QUOTES, 'UTF-8'); ?>" class="pg_produto">
                                                <h3><?php echo htmlspecialchars($favorito['nome_produto'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                                <p>Preço: R$ <?php echo number_format($favorito['preco_produto'], 2, ',', '.'); ?></p>
                                            </a>
                                            <button class="remover-favorito" data-produto-id="<?php echo $favorito['id_produto']; ?>">Remover</button>
                                        </div>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p>Você ainda não tem produtos favoritos.</p>
                            <?php endif; ?>





                        </div>




                        <div class="perfil_favoritos">
                            <div class="perfil_produtos_favortios">
                                <h2>Historico de reserva</h2>
                                <a href="http://localhost/guloseimas_do_olimpophp/public/Cliente/historico_reserva/">Visualizar</a>
                            </div>

                          

                        </div>


                    </div>
                </div>
            </article>
        </section>



        <div class="modal fade" id="modalRemoverFavorito" tabindex="-1" aria-labelledby="modalRemoverFavoritoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalRemoverFavoritoLabel">Remover Produto dos Favoritos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que deseja remover este produto dos seus favoritos?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirmarRemoverFavorito">Remover</button>
                    </div>
                </div>
            </div>
        </div>


    </main>

    <footer>
        <?php
        // Inclui o cabeçalho
        require(__DIR__ . '/../template/footer.php');
        ?>
    </footer>

    <?php
    // Inclui o script
    require(__DIR__ . '/../script_geral/script.php');
    ?>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let produtoId;

        const buttons = document.querySelectorAll('.remover-favorito');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                produtoId = this.getAttribute('data-produto-id');

                // Exibe o modal de confirmação
                const modal = new bootstrap.Modal(document.getElementById('modalRemoverFavorito'));
                modal.show();
            });
        });

        // Evento de confirmação no modal
        document.getElementById('confirmarRemoverFavorito').addEventListener('click', function() {
            fetch('<?php echo BASE_URL; ?>favoritos/removerFavorito', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id_produto: produtoId
                    }) // Passando o ID do produto
                })
                .then(response => response.json())
                .then(data => {
                    if (data.sucesso) {

                        location.reload(); // Recarrega a página para atualizar a lista
                    } else {

                    }
                })
                .catch(error => {
                    alert('Erro ao tentar remover o produto.');
                });

            // Fecha o modal após a confirmação
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalRemoverFavorito'));
            modal.hide();
        });
    });
</script>

</html>