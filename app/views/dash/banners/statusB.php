<!DOCTYPE html>
<html lang="pt-br">

</html>

<head>
    <?php
    require(__DIR__ . '/../../head_geral/head.php');
    ?>
</head>

<style>
    body,
    html {
        height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    h1 {
        font-size: 30pt;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }

    main {
        width: 100vh;
    }

    label {
        margin: 10px 0;
        font-size: 15pt;
        font-weight: bold;
    }

    input {
        margin: 10px 0;
    }

    button {
        margin-right: 20px;
        margin-top: 10px;
    }

    a {
        margin-top: 10px;
    }
</style>

<body>

    <main>
        <form action="<?php echo BASE_URL . 'produtos/atualizarStatusB'; ?>" method="POST" class="form-group">
            <input type="hidden" name="id_banner" value="<?php echo $banner['id_banner']; ?>">

            <div class="form-group">
                <label for="status_banner">Status:</label>
                <select name="status_banner" id="status_banner" class="form-control">
                    <option value="Ativo" <?php echo $banner['status_banner'] === 'Ativo' ? 'selected' : ''; ?>>Ativo</option>
                    <option value="Inativo" <?php echo $banner['status_banner'] === 'Inativo' ? 'selected' : ''; ?>>Inativo</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Salvar alterações</button>
                <a href="<?php echo BASE_URL . 'produtos/banner_produto'; ?>" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </main>

    <?php
    require(__DIR__ . '/../../script_geral/script.php');
    ?>

</body>

</html>