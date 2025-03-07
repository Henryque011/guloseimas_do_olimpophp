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
        <?php
        // Verifica se o produto foi carregado corretamente
        if (isset($banner_produto)):
        ?>
            <div class="container">
                <h1>Editar Produto</h1>

                <!-- Formulário de edição do produto -->
                <form action="<?php echo BASE_URL . 'produtos/atualizarBanner_produto/' . $banner_produto['id_banner']; ?>" method="POST" enctype="multipart/form-data">



                    <div class="form-group">
                        <label for="nome_banner">Nome do banner</label>
                        <input type="text" id="nome_banner" name="nome_banner" value="<?php echo htmlspecialchars($banner_produto['nome_banner']); ?>" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="alt_foto_banner">Texto Alternativo</label>
                        <input type="text" id="alt_foto_banner" name="alt_foto_banner" placeholder="Digite o texto alternativo" value="<?php echo htmlspecialchars($banner_produto['alt_foto_banner']); ?>" required class="form-control">
                    </div>




                    <div class="form-group">
                        <label for="foto_banner">Foto do Banner</label>
                        <input type="file" id="foto_banner" name="foto_banner" class="form-control">
                        <small>Deixe em branco para não alterar a imagem.</small>
                    </div>
                    <input type="hidden" name="foto_produto_antiga" value="<?php echo htmlspecialchars($banner_produto['foto_banner']); ?>">
                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                    <input type="hidden" name="id_banner" value="<?php echo $banner_produto['id_banner']; ?>">
                    <a href="<?php echo BASE_URL . 'produtos/banner_produto'; ?>" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        <?php else: ?>
            <p>Produto não encontrado.</p>
        <?php endif; ?>


    </main>

    

    </main>


    <?php
    // Inclui o script
    require(__DIR__ . '/../../script_geral/script.php');

    ?>

</body>

</html>