

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
      <th scope="col">Foto</th>
      <th scope="col">Nome da Galeria</th>
      <th scope="col">Texto Alternativo</th>
      <th scope="col">Descrição</th>
      <th scope="col">Status</th>
      <th scope="col">Editar</th>
      <th scope="col">Desativar/Ativar</th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($servicos)): ?>
      <?php foreach ($servicos as $linha): ?>
        <tr>
          <th scope="row"><?php echo $linha['id_servico']; ?></th>
          <td><img src="<?php echo BASE_URL . 'uploads/' . $linha['foto_servico']; ?>" alt="<?php echo $linha['alt_foto_servico']; ?>" class="pg_produto"></td>
          <td><?php echo htmlspecialchars($linha['nome_servico']); ?></td>
          <td><?php echo htmlspecialchars($linha['alt_foto_servico']); ?></td>
          <td><?php echo htmlspecialchars($linha['descricao_servico']); ?></td>
          <td>
            <?php echo ($linha['status_servico'] == 'Ativo') ? 'Ativo' : 'Inativo'; ?>
          </td>
          <td>

            <a href="<?php echo BASE_URL . 'sobre/editarS/' . $linha['id_servico']; ?>">
              <button><i class="bi bi-pencil-fill"></i></button>
            </a>


          </td>
          <td>
            <a href="<?php echo BASE_URL . 'sobre/status_S_S/' . $linha['id_servico']; ?>">
              <button><i class="bi bi-trash-fill"></i></button>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan="6">Nenhuma galeria encontrada.</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>
<script src="http://localhost/guloseimas_do_olimpophp/public/vendors/dash/js/adminlte.js"></script>
</html>