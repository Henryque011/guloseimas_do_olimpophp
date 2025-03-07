

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
    <?php if ($quem_sou_eu): ?>
      <tr>
        <th scope="row"><?php echo $quem_sou_eu['id_galeira']; ?></th>
        <td><img src="<?php echo BASE_URL . 'uploads/' . $quem_sou_eu['foto_galeria']; ?>" alt="<?php echo $quem_sou_eu['alt_foto_galeria']; ?>" class="pg_produto"></td>
        <td><?php echo htmlspecialchars($quem_sou_eu['nome_galeria']); ?></td>
        <td><?php echo htmlspecialchars($quem_sou_eu['alt_foto_galeria']); ?></td>
        <td>
          <?php echo ($quem_sou_eu['status_galeria'] == 'Ativo') ? 'Ativo' : 'Inativo'; ?>
        </td>
        <td>
          <a href="<?php echo BASE_URL . 'galeria/editarG/' . $quem_sou_eu['id_galeira']; ?>">
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
