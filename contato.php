<?php

define('TITLE', 'Contato | Programeiros');

include('includes/navbar.php');

?>

<div class="contato">
  <div class="col-md-8">
    <h1 class="title-main">Entre em contato conosco!</h1>
    <form>
    <div class="form-group">
      <input type="text" class="form-control" placeholder=" * Nome" autofocus>
    </div>
    <div class="form-group">
      <input type="email" class="form-control" placeholder=" * E-mail">
    </div>
    <div class="form-group">
      <input type="text" class="form-control" placeholder=" * Telefone">
    </div>
    <div class="form-group">
      <input type="text" class="form-control" placeholder=" Site(Opcional)">
    </div>
    <div class="form-group">
      <textarea name="" rows="3" class="form-control" placeholder=" * Mensagem"></textarea>
    </div>
    <button type="submit" class="btn btn-primary btn-mais">Submit</button>
  </form>
</div>

</div>

<?php include('includes/footer.php'); ?>
