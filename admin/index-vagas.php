<?php

session_start();

include('../includes/config.php');
include('../includes/db.php');

if(isset($_POST['login'])){
  $usuario =  trim(strip_tags($_POST['usuario']));
  $senha = trim(strip_tags($_POST['senha']));
  $cript_pass = md5(strrev($senha));

  $query = "SELECT * FROM empresas WHERE BINARY email=:usuario AND BINARY senha=:senha";

  try {
    $result = $PDO->prepare($query);
    $result->bindParam(':usuario',$usuario, PDO::PARAM_STR);
    $result->bindParam(':senha',$cript_pass, PDO::PARAM_STR);
    $result->execute();
    $contar = $result->rowCount();
    while($mostra = $result->FETCH(PDO::FETCH_ASSOC)) {
      $ativada = $mostra['ativada'];
      $nivel = $mostra['nivel'];
    }

    if($ativada != 1) {
      header("Location:index-vagas.php?err=Você ainda não ativou sua conta!!");
      exit();
    } else {
      if($contar>0) {
      $usuario =  $_POST['usuario'];
      $senha = $cript_pass;
      $_SESSION['usuario'] = $usuario;
      $_SESSION['senha'] = $cript_pass;
      $_SESSION['nivel'] = $nivel;

      header("Location:admin_page.php");

    } else {
      header("Location:index-vagas.php?err=Dados incorretos!!");
      exit();
    }
    }
    
  } catch(PDOException $e) {
    echo 'Erro:' . $e;
  }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Admin</title>
    <!-- Imports de libs -->
    <link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
    <link href="/Blog-Programeiros/libs/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="card card-container">
        <h2 class="text-title">Programeiros</h2>
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
        <?php if(isset($_GET['success'])) { ?>

        <div class="alert alert-success"><?php echo $_GET['success']; ?></div>

        <?php } ?>

        <?php if(isset($_GET['err'])) { ?>

       <div class="alert alert-danger"><?php echo $_GET['err']; ?></div>

       <?php } ?>
        <p id="profile-name" class="profile-name-card"></p>
        <form class="form-signin" method="post" action="#">
            <span id="reauth-email" class="reauth-email"></span>
            <input type="text" id="campo_user" name="usuario" class="form-control" placeholder="E-mail de acesso" required autofocus>
            <input type="password" name="senha" id="campo_pass" class="form-control" placeholder="Senha" required>
            <div id="remember" class="checkbox">
              <label>
                <input type="checkbox" value="remember-me"> Lembrar-me
              </label>
              <a href="#">Esqueceu a senha?</a>
            </div>
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="login">Entrar</button>
        </form><!-- /form -->
        <a href="#" class="forgot-password">Esqueceu sua senha?</a>

        <a href="/Blog-Programeiros/pages/cadastro.php" class="btn btn-lg btn-success btn-block btn-signin">Cadastre-se</a>
    </div><!-- /card-container -->
  </div><!-- /container -->
