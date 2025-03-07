





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
      <!-- <th scope="col">Tempo</th> -->
      <!-- <th scope="col">Especialidade</th> -->
      <th scope="col">Editar</th>
    

    </tr>
  </thead>
  <tbody>
    <?php foreach ($listarDestaque as $linha): ?>

      <tr>
        <th scope="row"><?php echo $linha['id_produto'] ?></th>
        <td><img src="<?php echo BASE_URL . 'uploads/' . $linha['foto_produto'] ?>" alt="<?php echo $linha['alt_foto_produto'] ?>" class="pg_produto"></td>

        <td><?php echo $linha['nome_produto'] ?></td>
       
        <td><?php echo $linha['preco_produto'] ?></td>


        <td>
          <a href="<?php echo BASE_URL . 'produtos/editar/' . $linha['id_produto']; ?>">
            <button><i class="bi bi-pencil-fill"></i></button>
          </a>
        </td>
      
      </tr>


    <?php endforeach; ?>
  </tbody>
</table>
<script src="http://localhost/guloseimas_do_olimpophp/public/vendors/dash/js/adminlte.js"></script>
</html>