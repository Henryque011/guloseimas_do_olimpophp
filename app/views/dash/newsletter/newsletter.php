

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

     
      <th scope="col">Email contato</th>
      <th scope="col">Data de envio</th>
      <th scope="col">Status contato</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($listarEmails as $linha): ?>
      <tr>
        <th scope="row"><?php echo $linha['id_newsletter']; ?></th>

       
      
        <td><?php echo htmlspecialchars($linha['email_newsletter']); ?></td>
        <td><?php echo htmlspecialchars($linha['data_inscricao_newsletter']); ?></td>
       



        <td>
         <?php echo ($linha['staus_newsletter']) ; ?>
        </td>



        </td>


      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<script src="http://localhost/guloseimas_do_olimpophp/public/vendors/dash/js/adminlte.js"></script>

</html>