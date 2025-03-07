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
        if (isset($info_produto)):
        ?>
            <div class="container">
                <h1>Editar Produto</h1>

                <!-- Formulário de edição do produto -->
                <form action="<?php echo BASE_URL . 'info_produtos/atualizar_info/' . $info_produto['id_info_produtos']; ?>" method="POST" enctype="multipart/form-data">


                
                    <div class="form-group">
                        <label for="nome_info_produtos">Nome do Produto</label>
                        <input type="text" id="nome_info_produtos" name="nome_info_produtos" value="<?php echo htmlspecialchars($info_produto['nome_produto']); ?>" required class="form-control">
                    </div>

                     <div class="form-group">
                        <label for="descricao_info_produto">Descrição</label>
                        <textarea id="descricao_info_produto" name="descricao_info_produto" required class="form-control"><?php echo htmlspecialchars($info_produto['descricao_info_produto']); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="preco_produto">Preço</label>
                        <input type="number" step="0.01" id="preco_produto" name="preco_produto" value="<?php echo htmlspecialchars($info_produto['preco_produto']); ?>" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="info_alt_foto_produto">Texto Alternativo</label>
                        <input type="text"  id="info_alt_foto_produto" name="info_alt_foto_produto" value="<?php echo htmlspecialchars($info_produto['alt_foto_produto']); ?>" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="forma_pagamento_info_produto">Forma de pagamento</label>
                        <input type="text"  id="forma_pagamento_info_produto" name="forma_pagamento_info_produto" value="<?php echo htmlspecialchars($info_produto['forma_pagamento_info_produto']); ?>" required class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="entrega_info_produtos">Entrega</label>
                        <input type="text"  id="entrega_info_produtos" name="entrega_info_produtos" value="<?php echo htmlspecialchars($info_produto['entrega_info_produtos']); ?>" required class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="reserva_info_produtos">Reservas</label>
                        <input type="text"  id="reserva_info_produtos" name="reserva_info_produtos" value="<?php echo htmlspecialchars($info_produto['reserva_info_produtos']); ?>" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="personalizacao_info_produtos">Personalizção</label>
                        <input type="text"  id="personalizacao_info_produtos" name="personalizacao_info_produtos" value="<?php echo htmlspecialchars($info_produto['personalizacao_info_produtos']); ?>" required class="form-control">
                    </div>



                    <div class="form-group">
                        <label for="foto_info_produto">Foto do Produto</label>
                        <input type="file" id="foto_info_produto" name="foto_info_produto" class="form-control">
                        <small>Deixe em branco para não alterar a imagem.</small>
                    </div> 
                    <input type="hidden" name="foto_produto_antiga" value="<?php echo htmlspecialchars($info_produto['foto_info_produto']); ?>">
                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                    <input type="hidden" name="id_info_produtos" value="<?php echo $info_produto['id_info_produtos']; ?>">
                    <a href="<?php echo BASE_URL . 'info_produtos/info_produtos'; ?>" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        <?php else: ?>
            <p>Produto não encontrado.</p>
        <?php endif; ?>


    </main>

   


    </main>


    <?php
    // Inclui o script
    require(__DIR__.'/../../script_geral/script.php');
   
    ?>

</body>

</html>