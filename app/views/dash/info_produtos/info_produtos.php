






<style>
  button {
    border: none;
    background-color: transparent;
  }

  .pg_produto{
    width: 230px;
    height: 230px;
    border-radius: 5px;
  }
</style>








<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Foto</th> 
      <th scope="col">Nome</th> 
     
      <th scope="col">Preço</th> 
      <th scope="col">Texto Alternativo</th> 
      <th scope="col">Descrição</th> 
      <th scope="col">Forma de pagamento</th>
      <th scope="col">Entrega</th> 
      <th scope="col">Reservas</th> 
      <th scope="col">Personalizção</th>
      <!-- <th scope="col">Tempo</th> -->
      <!-- <th scope="col">Especialidade</th> -->
      <th scope="col">Editar</th>
      

    </tr>
  </thead>
  <tbody>
    <?php foreach ($listarServico as $linha): ?>

      <tr>
        <th scope="row"><?php echo $linha['id_info_produtos'] ?></th>
        <td><img src="<?php echo BASE_URL . 'uploads/' . $linha['foto_info_produto'] ?>" alt="<?php echo $linha['alt_foto_produto'] ?>" class="pg_produto"></td>

        <td><?php echo $linha['nome_produto'] ?></td>
       
        <td><?php echo $linha['preco_produto'] ?></td>
        <td><?php echo $linha['info_alt_foto_produto'] ?></td>
        <td><?php echo $linha['descricao_info_produto'] ?></td>
        <td><?php echo $linha['forma_pagamento_info_produto'] ?></td>
        <td><?php echo $linha['entrega_info_produtos'] ?></td>
        <td><?php echo $linha['reserva_info_produtos'] ?></td>
        <td><?php echo $linha['personalizacao_info_produtos'] ?></td>

        <td>
          <a href="<?php echo BASE_URL . 'info_produtos/editarI/' . $linha['id_info_produtos']; ?>">
            <button><i class="bi bi-pencil-fill"></i></button>
          </a>
        </td>
        
      </tr>


    <?php endforeach; ?>


    
  </tbody>
</table>
<script src="http://localhost/guloseimas_do_olimpophp/public/vendors/dash/js/adminlte.js"></script>
</html>