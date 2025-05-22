<!DOCTYPE html>
<html lang="pt-br">
<?php
require_once('template/head.php')
?>
<style>
    body {
        background-color: #FEFBF3;
    }

    header {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .esqueci_senha {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        justify-content: center;
    }

    .site {
        margin: 0 auto;
        max-width: 400px;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    h2 {
        font-family: "Poly";
        font-size: 16pt;
        text-transform: uppercase;
        color: #985C41;
        text-align: center;
        font-weight: 300;
    }

    .container {
        width: 100%;
        height: 190px;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        text-align: center;
        align-self: flex-start;
        background-color: #ffffff;
        border-radius: 20px;
        margin: 20px 0 20px;
        border: c4001af5;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;

            label {
                font-family: "Jacques Francois";
                text-transform: capitalize;
                color: #0B3222;
                font-weight: 500;
                font-size: 16pt;
                margin: 5px 0 5px 0;
            }

            input#nova_senha {
                width: 100%;
                height: auto;
                margin: 10px 0 0px 0;
                border: none;
                font-size: large;
            }

            input:focus {
                outline: none;
                background-color: transparent;
            }

            .box {
                display: flex;
            }

            hr {
                background: black;
                width: 100%;
                margin: 1px 0 0 0;
            }

            input.btn-link {
                width: 150px;
                height: 40px;
                margin-top: 20px;
                border-radius: 20px;
                font-family: "Poly";
                font-weight: 599;
                font-size: 12pt;
                border-color: #985C41;
                box-shadow: rgba(136, 165, 191, 0.48) 6px 2px 16px 0px, rgba(255, 255, 255, 0.8) -6px -2px 16px 0px;
            }

            button {
                border: none;
                background-color: transparent;
                font-size: large;

                i {
                    color: #985C41;
                }
            }
        }
    }

    .button_voltar {
        width: 250px;
        height: 50px;
        background-color: #c4001af5;
        border-radius: 5px;
        align-items: center;
        text-align: center;
        display: flex;
        justify-content: center;

        a {
            font-weight: bolder;
            letter-spacing: 2px;
            border: none;
            color: white;
            text-decoration: none;
            text-transform: uppercase;
            font-family: Poly;

            i {
                margin: 0 5px 0 0;
            }
        }
    }
</style>

<body>
    <header>
        <a href="<?php echo BASE_URL; ?>index.php?url=initial"><img src="<?php echo BASE_URL; ?>assets/img/logo_header.svg" alt="Logo Guloseimas do olimpo"></a>
    </header>
    <section class="esqueci_senha">
        <article class="site">
            <h2>Recuperar senha</h2>
            <div class="container">

                <?php if (!empty($_SESSION['flash']) && is_array($_SESSION['flash'])): ?>
                    <div class="alert <?= $_SESSION['flash']['tipo'] ?>">
                        <?= $_SESSION['flash']['mensagem'] ?>
                    </div>
                    <?php unset($_SESSION['flash']); ?>
                <?php endif; ?>

                <form action="<?= BASE_URL ?>index.php?url=api/resetarSenha" method="POST">
                <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token'] ?? '') ?>">

                    <label for="nova_senha">Nova Senha:</label>
                    <div class="box">
                        <input type="password" name="nova_senha" id="nova_senha" required>
                        <button type="button" id="toggleSenha"><i class="fa-solid fa-eye-slash fa-rotate-by"></i></button>
                    </div>
                    <hr>
                    <input type="submit" value="Salvar Nova Senha" class="btn-link">
                </form>
            </div>
        </article>
        <div class="button_voltar">
            <a href="<?php echo BASE_URL; ?>index.php?url=initial"><i class="fa-solid fa-backward"></i>Voltar</a>
        </div>
    </section>

    <script>
        document.getElementById('toggleSenha').addEventListener('click', function() {
            let senhaInputs = [
                document.getElementById('nova_senha')
            ];
            let icon = this.querySelector('i');

            senhaInputs.forEach(input => {
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            });
        });
    </script>
</body>

</html>