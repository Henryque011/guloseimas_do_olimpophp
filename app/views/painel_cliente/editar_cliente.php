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
                    <h2>Editar conta</h2>
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
                        <form method="POST" action="<?php echo BASE_URL; ?>cliente/salvarEdicaoCliente" id="formEditar">
                            <div class="nome_entrar">

                                <div class="email_entrar">
                                    <label for="email"></label>
                                    <input type="email" name="email" id="email"
                                        value="<?php echo htmlspecialchars($dados['email']); ?>"
                                        placeholder="Seu endereço de e-mail" disabled>
                                </div>

                                <div class="entrar_email">
                                    <label for="nome"></label>
                                    <input type="text" name="nome" id="nome"
                                        value="<?php echo htmlspecialchars($dados['nome']); ?>"
                                        placeholder="Seu nome completo" required>
                                </div>

                                <div class="email_entrar">
                                    <label for="cpf"></label>
                                    <input type="text" id="cpf" name="cpf"
                                        value="<?php echo htmlspecialchars($dados['cpf']); ?>"
                                        placeholder="Digite seu CPF" required>
                                </div>

                                <div class="email_entrar">
                                    <label for="telefone"></label>
                                    <input type="tel" id="telefone" name="telefone"
                                        value="<?php echo htmlspecialchars($dados['telefone']); ?>"
                                        placeholder="Seu número de telefone" required>
                                </div>

                                <div class="email_entrar">
                                    <label for="data_nascimento"></label>
                                    <input type="date" id="data_nascimento" name="data_nascimento"
                                        value="<?php echo htmlspecialchars($dados['nascimento']); ?>"
                                        required>
                                </div>

                            </div>

                            <div class="voltar_salvar" >
                                <div class="button_forms">
                                    <button type="submit" id="btnSalvarSenha" class="btn btn-primary">Editar</button>

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
    <div class="modal fade" id="modalSucesso" tabindex="-1" aria-labelledby="modalSucessoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSucessoLabel">Sucesso!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    Sua conta foi editada com sucesso!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
  

    <!-- Script para exibir o modal após salvar -->
    <script>
        document.getElementById('formEditar').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita que o formulário seja enviado imediatamente

            // Simula o envio dos dados (aqui você pode integrar um AJAX se quiser)
            setTimeout(() => {
                let modal = new bootstrap.Modal(document.getElementById('modalSucesso'));
                modal.show();
            }, 500);

            // Após fechar o modal, pode redirecionar ou submeter o formulário real
            document.getElementById('modalSucesso').addEventListener('hidden.bs.modal', function () {
                document.getElementById('formEditar').submit();
            });
        });
    </script>

</body>

</html>
