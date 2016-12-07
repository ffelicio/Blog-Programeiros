<?php

	include('../includes/config.php');
	include('../includes/db.php');

	if(isset($_GET['token'])) {
		$token = trim(strip_tags($_GET['token']));

		$sql = "SELECT * FROM empresas WHERE token=:token";

		$result = $PDO->prepare($sql);
		$result->bindParam(':token',$token, PDO::PARAM_STR);
	  $result->execute();
	  $contar = $result->rowCount();

	  if($contar < 1) {
	  	header("location:http://localhost/Blog-Programeiros/admin/ativar.php?token'$token'&err=" . urlencode('Token incorreto, favor contatar o Administrador do sistema!'));
	  	exit();
	  }

	  while($mostra = $result->FETCH(PDO::FETCH_ASSOC)) {
	  	$ativada = $mostra['ativada'];
	  }

	  if($ativada == 0) {
	  	$update = "UPDATE empresas SET ativada=1 WHERE token=:token";
			$resultado = $PDO->prepare($update);
			$resultado->bindParam(':token',$token, PDO::PARAM_STR);
		  $resultado->execute();

		  header("location:http://localhost/Blog-Programeiros/admin/ativar.php?token'$token'&success=" . urlencode('Sua conta foi ativada!'));

	  } else {
	  	header("location:http://localhost/Blog-Programeiros/admin/ativar.php?token'$token'&err=" . urlencode('Esta conta já foi ativada anteriomente!'));
	  }
	  
	}

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro</title>
    <!-- Imports de libs -->
    <link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
    <link href="/Blog-Programeiros/libs/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
		<div class="container">
      <div class="card">

  	<?php if(isset($_GET['success'])) : ?>

      <div class="alert alert-success"><?= $_GET['success'] ?></div>

    <?php endif; ?>

    <?php if(isset($_GET['err'])) : ?>

      <div class="alert alert-danger"><?= $_GET['err'] ?></div>
  
    <?php endif; ?>

    <a href="http://localhost/Blog-Programeiros" class="btn btn-primary">Voltar para o site!</a>
    <a href="http://localhost/Blog-Programeiros/admin/index-vagas.php"  class="btn btn-success">Faça login!</a>

    	</div>
		</div>
  </body>
</html>