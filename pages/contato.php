<?php

define('TITLE', 'Contato');


?>
<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
<link rel="stylesheet" type="text/css" href="../assets/css/navbar.css">
<link href="../libs/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
<nav class="navbar navbar-findcond navbar-fixed-top">
    <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="index.php"><h1 class="brand-text">Programeiros Blog</h1></a>
    </div>
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="http://localhost/blog-programeiros/">Home</a></li>
        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Categorias <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="categoria.php?c=php">PHP</a></li>
            <li><a href="categoria.php?c=python">Python</a></li>
            <li><a href="categoria.php?c=ruby">Ruby</a></li>
          </ul>
        </li>
        <li><a href="pages/contato.php">Contato</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container contato" style="margin-top:100px;">
  <div class="row">
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
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>


</div>

<?php include('../includes/footer.php'); ?>
