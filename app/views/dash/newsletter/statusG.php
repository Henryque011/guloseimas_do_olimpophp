<!DOCTYPE html>
<html lang="pt-br">

</html>


<head>
    <?php
    // Inclui o head
    require(__DIR__ . '/../../head_geral/head.php');

    ?>
</head>

<body>
    <header>


        <?php
        // Inclui o cabeçalho
        require(__DIR__ . '/../../template/header.php');
        ?>
    </header>

    <main>
        <form action="<?php echo BASE_URL . 'galeria/atualizarStatusG'; ?>" method="POST" class="form-group">
            <input type="hidden" name="id_galeira" value="<?php echo $galeria_pg['id_galeira']; ?>">

            <div class="form-group">
                <label for="status_galeria">Status:</label>
                <select name="status_galeria" id="status_galeria" class="form-control">
                    <option value="Ativo" <?php echo $galeria_pg['status_galeria'] === 'Ativo' ? 'selected' : ''; ?>>Ativo</option>
                    <option value="Inativo" <?php echo $galeria_pg['status_galeria'] === 'Inativo' ? 'selected' : ''; ?>>Inativo</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Salvar alterações</button>
                <a href="<?php echo BASE_URL . 'produtos/listar'; ?>" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </main>

    <footer>
        <?php
        // Inclui o cabeçalho
        require(__DIR__ . '/../../template/footer.php');

        ?>
    </footer>


    </main>


    <?php
    // Inclui o script
    require(__DIR__ . '/../../script_geral/script.php');

    ?>

</body>

</html>