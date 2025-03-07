

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
    </tr>
  </thead>
  <tbody>
    <?php if ($minha_historia): ?>
      <tr>
        <th scope="row"><?php echo $minha_historia['id_galeira']; ?></th>
        <td><img src="<?php echo BASE_URL . 'uploads/' . $minha_historia['foto_galeria']; ?>" alt="<?php echo $minha_historia['alt_foto_galeria']; ?>" class="pg_produto"></td>
        <td><?php echo htmlspecialchars($minha_historia['nome_galeria']); ?></td>
        <td><?php echo htmlspecialchars($minha_historia['alt_foto_galeria']); ?></td>
        <td>
          <?php echo ($minha_historia['status_galeria'] == 'Ativo') ? 'Ativo' : 'Inativo'; ?>
        </td>
        <td>
          <a href="<?php echo BASE_URL . 'galeria/editarG/' . $minha_historia['id_galeira']; ?>">
            <button><i class="bi bi-pencil-fill"></i></button>
          </a>
      
        </td>
      </tr>
    <?php else: ?>
      <tr>
        <td colspan="6">Nenhuma galeria de qualidade encontrada.</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>
<script src="http://localhost/guloseimas_do_olimpophp/public/vendors/dash/js/adminlte.js"></script>
</html>
