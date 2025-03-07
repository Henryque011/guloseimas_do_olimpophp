<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php
    // Inclui o head
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


        <div class="container">
            <?php if (isset($_SESSION['mensagem'])): ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['mensagem'];
                    unset($_SESSION['mensagem']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['erro'])): ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['erro'];
                    unset($_SESSION['erro']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($categoria_produto)): ?>
                <h1>Editar Categoria</h1>

                <form action="<?php echo BASE_URL . 'produtos/atualizarC'; ?>" method="POST">
                    <input type="hidden" name="id_categoria" value="<?php echo $categoria_produto['id_categoria']; ?>">

                    <div class="form-group">
                        <label for="nome_categoria">Nome da Categoria</label>
                        <input type="text" id="nome_categoria" name="nome_categoria"
                            value="<?php echo htmlspecialchars($categoria_produto['nome_categoria']); ?>"
                            required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="descricao_categoria">Descrição da Categoria</label>
                        <textarea id="descricao_categoria" name="descricao_categoria"
                            required class="form-control"><?php echo htmlspecialchars($categoria_produto['descricao_categoria']); ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Salvar Alterações</button>
                    <a href="<?php echo BASE_URL . 'produtos/listar_categoria'; ?>" class="btn btn-danger">Cancelar</a>
                </form>

            <?php else: ?>
                <p>Categoria não encontrada.</p>
            <?php endif; ?>

        </div>






        <?php
        // Inclui o script
        require(__DIR__ . '/../../script_geral/script.php');
        ?>
</body>

</html>