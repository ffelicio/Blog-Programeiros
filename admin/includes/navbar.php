<?php
session_start();
include('../includes/config.php');
include('../includes/db.php');
include('../includes/functions.php');

if(!loggedIn()){
    header("Location:index.php?err=" . urlencode("Você precisa estar logado para acessar sua conta!!"));
    exit();
}

if(isset($_GET['acao'])) {
    $acao = $_GET['acao'];
} else {
    $acao = '';
}

$usuario = $_SESSION['usuario'];

$user = 'SELECT * FROM login WHERE usuario = :usuario';
$resultado = $PDO->prepare($user);
$resultado->bindValue(':usuario', $usuario, PDO::PARAM_STR);
$resultado->execute();
$count=$resultado->rowCount();
if($count=1) {
    while($nomeUser = $resultado->fetch(PDO::FETCH_ASSOC)) {
        $nomeUsuario = $nomeUser['nome'];
    }

}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Programeiros - Sistema de Postagem</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="../libs/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../libs/font-awesome-4.7.0/css/font-awesome.min.css">
<link href="../assets/css/admin_navbar.css" rel="stylesheet">
</head>
<body>
  <header>
    <div class="menu">
    <div class="container-fluid">
    <div class="navbar-header">
      <a href="#">Programeiros</a>
    </div>
    <div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php" ><span class="glyphicon glyphicon-off"></span> Sair</a></li>
      </ul>
      <div class="dropdown">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="" ><span class="glyphicon glyphicon-list-alt"></span> Posts</a></li>
            <ul class="nav navbar-nav navbar-right">
            <li><a href="" ><span class="glyphicon glyphicon-bell"></span> Visualizar Site</a></li>
             </ul>
        </ul>
      </div>
      <ul class="nav navbar-nav navbar-right">
          <li><a href="" ><span class="glyphicon glyphicon-flash"></span> Vagas</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <li><a href="" ><span class="glyphicon glyphicon-user"></span> Usuarios</a></li>
      </ul>  
    </div>
  </div>
</div>
</header>

    <div class="container">
      <div class="row">
        <div class="alert alert-info">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Olá, <?php echo $nomeUsuario; ?></strong>, Seja Bem vindo!
        </div>

<div class="container">
  <div class="navbar navbar submenu" role="banner">
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="admin_page.php">Início</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Postagens <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="postagens.php">Visualizar</a></li>
            <li><a href="cadastra_post.php">Cadastrar</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuários <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="usuarios.php">Visualizar</a></li>
            <li><a href="cadastra_user.php">Cadastrar</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Vagas <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="vagas.php">Visualizar</a></li>
            <li><a href="cadastra_vaga.php">Cadastrar</a></li>
          </ul>
        </li>
      </ul>
    </div>
    </div>
  </div>
</nav>
<script type="text/javascript">
  function showSite() {
    window.open("../index.php");
  }
</script>
