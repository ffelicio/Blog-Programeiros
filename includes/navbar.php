<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>
        <?php echo TITLE; ?>
    </title>
    <!-- Importe de libs -->
    <link href="/Blog-Programeiros/libs/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/Blog-Programeiros/libs/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/Blog-Programeiros/assets/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="/Blog-Programeiros/assets/css/style.css">
</head>
<body>
  <nav class="navbar navbar-findcond navbar-fixed-top">
    <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="/Blog-Programeiros/index.php"><h1 class="brand-text">Programeiros 2IN1</h1></a>
    </div>
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="/Blog-Programeiros/index.php">Home</a></li>
        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Categorias <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/Blog-Programeiros/pages/categoria.php?c=php">PHP</a></li>
            <li><a href="/Blog-Programeiros/pages/categoria.php?c=python">Python</a></li>
            <li><a href="/Blog-Programeiros/pages/categoria.php?c=ruby">Ruby</a></li>
          </ul>
        </li>
        <li><a href="/Blog-Programeiros/pages/vagas.php">Vagas</a></li>
        <li><a href="/Blog-Programeiros/pages/contato.php">Contato</a></li>
      </ul>
    </div>
  </div>
</nav>

<section id="blog" class="container posts" style="margin-top:100px;">
  <div class="row">