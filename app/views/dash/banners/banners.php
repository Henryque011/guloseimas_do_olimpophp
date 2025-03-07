

<style>
  button {
    border: none;
    background-color: transparent;
  }

  .pg_produto {
    width: 500px;
    height: 230px;
    border-radius: 5px;
  }
</style>



<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Foto</th>
      <th scope="col">Nome da Galeria</th>
      <th scope="col">Texto Alternativo</th>
      <th scope="col">Status</th>
      <th scope="col">Editar</th>
      <th scope="col">Desativar/Ativar</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($listarServico as $linha): ?>
      <tr>
        <th scope="row"><?php echo $linha['id_banner']; ?></th>
        <td><img src="<?php echo BASE_URL . 'uploads/' . $linha['foto_banner']; ?>" alt="<?php echo $linha['alt_foto_banner']; ?>" class="pg_produto"></td>
        <td><?php echo htmlspecialchars($linha['nome_banner']); ?></td>
        <td><?php echo htmlspecialchars($linha['alt_foto_banner']); ?></td>
        <td><?php echo htmlspecialchars($linha['status_banner']); ?></td>


        </td>

        <td>
          <a href="<?php echo BASE_URL . 'produtos/editarB/' . $linha['id_banner']; ?>">
            <button><i class="bi bi-pencil-fill"></i></button>
          </a>
          
        </td>

        <td>
        <a href="<?php echo BASE_URL . 'produtos/statusB/' . $linha['id_banner']; ?>">
            <button><i class="bi bi-trash-fill"></i></button>
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<script src="http://localhost/guloseimas_do_olimpophp/public/vendors/dash/js/adminlte.js"></script>
</html>