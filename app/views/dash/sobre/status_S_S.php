<!DOCTYPE html>
<html lang="pt-br">

</html>


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
        <form action="<?php echo BASE_URL . 'sobre/atualizarstatus_S_S'; ?>" method="POST" class="form-group">
            <input type="hidden" name="id_servico" value="<?php echo $galeria_pg['id_servico']; ?>">

            <div class="form-group">
                <label for="status_servico">Status:</label>
                <select name="status_servico" id="status_servico" class="form-control">
                    <option value="Ativo" <?php echo $galeria_pg['status_servico'] === 'Ativo' ? 'selected' : ''; ?>>Ativo</option>
                    <option value="Inativo" <?php echo $galeria_pg['status_servico'] === 'Inativo' ? 'selected' : ''; ?>>Inativo</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Salvar alterações</button>
                <a href="<?php echo BASE_URL . 'sobre/servicos'; ?>" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </main>

    

    </main>


    <?php
    // Inclui o script
    require(__DIR__ . '/../../script_geral/script.php');

    ?>

</body>

</html>