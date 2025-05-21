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

    site {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    h2 {
        font-family: 'Poly';
        font-size: 16pt;
        text-transform: capitalize;
        color: #985C41;
        text-align: center;
    }

    h3 {}
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
                
                <form action="/api/resetarSenha" method="POST">
                    <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token'] ?? '') ?>">

                    <label for="nova_senha">Nova Senha:</label>
                    <input type="password" name="nova_senha" id="nova_senha" required>

                    <input type="submit" value="Salvar Nova Senha">
                </form>
            </div>
        </article>
        <div class="button_voltar">
            <a href="<?php echo BASE_URL; ?>index.php?url=initial"><i class="fa-solid fa-backward"></i>Voltar</a>
        </div>
    </section>

</body>

</html>