<style>
  button {
    border: none;
    background-color: transparent;
  }

  .pg_produto {
    width: 230px;
    height: 230px;
    border-radius: 5px;
  }
</style>



<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>

      <th scope="col">Nome da categoria</th>
      <th scope="col">Descrição categoria</th>
      <th scope="col">Status</th>
      <th scope="col">Editar</th>
      <th scope="col">Desativar/Ativar</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($listar_categoria as $linha): ?>
      <tr>
        <th scope="row"><?php echo $linha['id_categoria']; ?></th>

        <td><?php echo htmlspecialchars($linha['nome_categoria']); ?></td>
        <td><?php echo htmlspecialchars($linha['descricao_categoria']); ?></td>
        <td>
          <?php echo ($linha['status_categoria'] == 'Ativo') ? 'Ativo' : 'Inativo'; ?>
        </td>

        <td>
          <a href="<?php echo BASE_URL . 'produtos/editarC/' . $linha['id_categoria']; ?>">
            <button><i class="bi bi-pencil-fill"></i></button>

        </td>

        <td>
          <a href="<?php echo BASE_URL . 'produtos/statusC/' . $linha['id_categoria']; ?>">
            <button><i class="bi bi-trash-fill"></i></button>
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<script src="http://localhost/guloseimas_do_olimpophp/public/vendors/dash/js/adminlte.js"></script>

</html>