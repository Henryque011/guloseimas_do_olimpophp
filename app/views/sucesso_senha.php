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
        font-family: "Poly";
        font-size: 16pt;
        text-transform: uppercase;
        color: #985C41;
        text-align: center;
        font-weight: 300;
    }
</style>

<body>
    <section class="msg">
        <article class="site">
            <h2><?= isset($mensagem) ? htmlspecialchars($mensagem) : 'Mensagem não disponível.' ?></h2>
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