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

    .site {
        margin: 0 auto;
        max-width: 400px;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    h2 {
        margin-top: 20px;
        font-family: "Poly";
        font-size: 16pt;
        text-transform: uppercase;
        color: #985C41;
        text-align: center;
        font-weight: 300;
    }

    .button_voltar {
        margin: 20px;
        width: 200px;
        height: 35px;
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
    <section class="msg">
        <article class="site">
            <h2><?= isset($mensagem) ? htmlspecialchars($mensagem) : 'Mensagem não disponível.' ?></h2>
            <div class="button_voltar">
                <a href="<?php echo BASE_URL; ?>"><i class="fa-solid fa-backward"></i>Voltar</a>
            </div>
        </article>
    </section>

</body>

<script>
    fetch('/api/resetarSenha', {
            method: 'POST',
            body: new URLSearchParams({
                token: token,
                nova_senha: novaSenha
            })
        }).then(response => response.json())
        .then(data => {
            if (data.mensagem) {
                // sucesso: redireciona para página de sucesso com mensagem
                window.location.href = 'sucesso.senha.php?msg=' + encodeURIComponent(data.mensagem);
            } else if (data.erro) {
                // erro: redireciona para página de erro ou mostra mensagem
                window.location.href = 'sucesso.senha.php?msg=' + encodeURIComponent(data.erro);
            }
        });
</script>

</html>