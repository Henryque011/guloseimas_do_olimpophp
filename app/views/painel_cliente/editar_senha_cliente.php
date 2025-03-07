<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php require(__DIR__ . '/../head_geral/head.php'); ?>

    <!-- Bootstrap CSS -->

</head>

<body>
    <header>
        <?php require(__DIR__ . '/../template/header.php'); ?>
    </header>

    <main>
        <section class="brigadeiros">
            <article class="site">
                <div>
                    <h2>Alterar senha</h2>
                </div>
                <div>
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/BRIGADEIRO 2.svg" alt="brigadeiros">
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/BRIGADEIRO 3.svg" alt="brigadeiros">
                </div>
            </article>
        </section>

        <section class="login_contato">
            <article class="site">
                <div class="lado_a_lado">
                    <div class="forms_contato">
                        <form method="POST" action="<?php echo BASE_URL; ?>cliente/salvarEdicaoSenhaCliente" id="formEditarSenha">
                            <div class="senha_entrar">

                                <div class="email_entrar">
                                    <label for="senha_atual"></label>
                                    <input type="password" name="senha_atual" id="senha_atual"
                                        placeholder="Digite sua senha atual" required>
                                </div>

                                <div class="email_entrar">
                                    <label for="nova_senha"></label>
                                    <input type="password" name="nova_senha" id="nova_senha"
                                        placeholder="Digite sua nova senha" required>
                                </div>

                                <div class="email_entrar">
                                    <label for="confirmar_senha"></label>
                                    <input type="password" name="confirmar_senha" id="confirmar_senha"
                                        placeholder="Confirme sua nova senha" required>
                                </div>

                            </div>
                            <div class="voltar_salvar" >
                                <div class="button_forms">
                                    <button type="submit" id="btnSalvarSenha" class="btn btn-primary">Alterar Senha</button>

                                </div>
                                <div class="voltar_painel">
                                    <a href="<?php echo BASE_URL; ?>cliente">Voltar</a>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </article>
        </section>

        <section class="brigadeiros">
            <article class="site">
                <div></div>
                <div>
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/BRIGADEIRO 4.svg" alt="brigadeiros">
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/BRIGADEIRO 5.svg" alt="brigadeiros">
                </div>
            </article>
        </section>
    </main>

    <footer>
        <?php require(__DIR__ . '/../template/footer.php'); ?>
    </footer>

    <!-- Modal de Confirmação -->
    <div class="modal fade" id="modalSenhaSucesso" tabindex="-1" aria-labelledby="modalSenhaSucessoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSenhaSucessoLabel">Sucesso!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    Sua senha foi alterada com sucesso!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Erro -->
    <div class="modal fade" id="modalSenhaErro" tabindex="-1" aria-labelledby="modalSenhaErroLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="modalSenhaErroLabel">Erro!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    Senha atual incorreta!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Script para exibir o modal -->
    <script>
        document.getElementById('formEditarSenha').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita o envio padrão do formulário

            let formData = new FormData(this); // Captura os dados do formulário

            fetch('<?php echo BASE_URL; ?>cliente/salvarEdicaoSenhaCliente', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json()) // Recebe a resposta do servidor em JSON
                .then(data => {
                    if (data.sucesso) {
                        // Se a senha foi alterada com sucesso, exibe o modal de sucesso
                        let modalSucesso = new bootstrap.Modal(document.getElementById('modalSenhaSucesso'));
                        modalSucesso.show();

                        // Após fechar o modal, recarrega a página ou redireciona
                        document.getElementById('modalSenhaSucesso').addEventListener('hidden.bs.modal', function() {
                            window.location.reload(); // Recarrega a página após sucesso
                        });
                    } else {
                        // Se a senha estiver incorreta, mostra o modal de erro com a mensagem
                        let modalErro = new bootstrap.Modal(document.getElementById('modalSenhaErro'));
                        let modalBody = modalErro._element.querySelector('.modal-body');
                        modalBody.innerHTML = data.erro; // Exibe a mensagem de erro no modal
                        modalErro.show();
                    }
                })
                .catch(error => console.error('Erro:', error));
        });
    </script>


</body>

</html>