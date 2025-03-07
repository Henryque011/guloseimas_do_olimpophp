<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php
    // Inclui o head
    require(__DIR__ . '/../../head_geral/head.php');
    ?>
</head>
<style>
    body , html{
        height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    h1{
        font-size: 30pt;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
      
    }


    main{
      width: 100vh;
    
    }

    label{
        margin: 10px 0;
        font-size: 15pt;
        font-weight: bold;
    }

    
input{
    margin: 10px 0;
}

button{
    margin-right: 20px;
    margin-top: 10px;
}

a{
margin-top: 10px;
}

</style>
<body>
    
    <main>


    <div class="container">
    <?php if (isset($_SESSION['mensagem'])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['erro'])): ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['erro']; unset($_SESSION['erro']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($foto)): ?>
        <h1>Editar Foto da Galeria</h1>

        <form action="<?php echo BASE_URL . 'sobre/atualizarImagem_servico/' . $foto['id_servico']; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_servico" value="<?php echo $foto['id_servico']; ?>">
            <input type="hidden" name="foto_servico_antiga" value="<?php echo htmlspecialchars($foto['foto_servico']); ?>">

            <div class="form-group">
                <label for="nome_servico">Nome da Servico</label>
                <input type="text" id="nome_servico" name="nome_servico" placeholder="Digite o nome do servico" value="<?php echo htmlspecialchars($foto['nome_servico']); ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label for="descricao_servico">Descrição serviço</label>
                <input type="text" id="descricao_servico" name="descricao_servico" placeholder="Digite a descrição do serviço" value="<?php echo htmlspecialchars($foto['descricao_servico']); ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label for="alt_foto_servico">Texto Alternativo</label>
                <input type="text" id="alt_foto_servico" name="alt_foto_servico" placeholder="Digite o texto alternativo" value="<?php echo htmlspecialchars($foto['alt_foto_servico']); ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label>Imagem Atual</label>
                <img src="<?php echo BASE_URL . 'uploads/' . $foto['foto_servico']; ?>" 
                     alt="<?php echo htmlspecialchars($foto['alt_foto_servico']); ?>" 
                     style="max-width: 200px; display: block; margin-bottom: 10px;">
            </div>

            <div class="form-group">
                <label for="foto_servico">Nova Foto</label>
                <input type="file" id="foto_servico" name="foto_servico" class="form-control">
                <small>Deixe em branco se não quiser alterar a foto.</small>
            </div>

            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <a href="<?php echo BASE_URL . 'sobre/servicos'; ?>" class="btn btn-danger">Cancelar</a>
        </form>
    <?php else: ?>
        <p>Foto não encontrada.</p>
    <?php endif; ?>
</div>




   

    <?php
    // Inclui o script
    require(__DIR__ . '/../../script_geral/script.php');
    ?>
</body>

</html>