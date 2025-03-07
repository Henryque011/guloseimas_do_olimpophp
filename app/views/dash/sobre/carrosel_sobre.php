

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
      <th scope="col">Status</th>
      <th scope="col">Editar</th>
      <th scope="col">Desativar/Ativar</th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($carrosel_sobre)): ?>
      <?php foreach ($carrosel_sobre as $linha): ?>
        <tr>
          <th scope="row"><?php echo $linha['id_galeira']; ?></th>
          <td><img src="<?php echo BASE_URL . 'uploads/' . $linha['foto_galeria']; ?>" alt="<?php echo $linha['alt_foto_galeria']; ?>" class="pg_produto"></td>
          <td><?php echo htmlspecialchars($linha['nome_galeria']); ?></td>
          <td><?php echo htmlspecialchars($linha['alt_foto_galeria']); ?></td>
          <td>
            <?php echo ($linha['status_galeria'] == 'Ativo') ? 'Ativo' : 'Inativo'; ?>
          </td>
          <td>
            <a href="<?php echo BASE_URL . 'galeria/editarG/' . $linha['id_galeira']; ?>">
              <button><i class="bi bi-pencil-fill"></i></button>
            </a>
          <td>
            <a href="<?php echo BASE_URL . 'galeria/status_S_G/' . $linha['id_galeira']; ?>">
              <button><i class="bi bi-trash-fill"></i></button>
            </a>
          </td>

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