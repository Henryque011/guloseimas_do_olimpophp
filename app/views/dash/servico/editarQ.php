<!DOCTYPE html>
<html lang="pt-br">

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
    <div class="container">
        <?php if (isset($foto)): ?>
            <h1>Editar Foto da Galeria</h1>

            <!-- Formulário de edição da foto da galeria -->
            <form action="<?php echo BASE_URL . 'galeria/atualizar_qualidade/' . $foto['id_galeira']; ?>" method="POST" enctype="multipart/form-data">
                <!-- Campo oculto para enviar o ID da galeria -->
                <input type="hidden" name="id_galeira" value="<?php echo $foto['id_galeira']; ?>">

                <!-- Campo para o nome da galeria -->
                <div class="form-group">
                    <label for="nome_galeria">Nome da Galeria</label>
                    <input type="text" id="nome_galeria" name="nome_galeria" value="<?php echo htmlspecialchars($foto['nome_galeria']); ?>" required class="form-control">
                </div>

                <!-- Campo para o texto alternativo -->
                <div class="form-group">
                    <label for="alt_foto_galeria">Texto Alternativo</label>
                    <input type="text" id="alt_foto_galeria" name="alt_foto_galeria" value="<?php echo htmlspecialchars($foto['alt_foto_galeria']); ?>" required class="form-control">
                </div>

                <!-- Campo para selecionar nova foto -->
                <div class="form-group">
                    <label for="foto_galeria">Nova Foto</label>
                    <input type="file" id="foto_galeria" name="foto_galeria" class="form-control">
                    <small>Deixe em branco se não quiser alterar a foto.</small>
                </div>

             

                <!-- Botões de ação -->
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="<?php echo BASE_URL . 'galeria'; ?>" class="btn btn-secondary">Cancelar</a>
            </form>
        <?php else: ?>
            <p>Foto não encontrada.</p>
        <?php endif; ?>
    </div>
</main>



    <footer>
        <?php
        // Inclui o rodapé
        require(__DIR__ . '/../../template/footer.php');
        ?>
    </footer>

    <?php
    // Inclui o script
    require(__DIR__ . '/../../script_geral/script.php');
    ?>
</body>
</html>
