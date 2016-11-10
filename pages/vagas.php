<?php

@define(TITLE, "Vagas | Programeiros");

include('../includes/config.php');
include('../includes/db.php');
include('../includes/navbar.php');

$sql = "SELECT * FROM vagas ORDER BY id_vaga DESC LIMIT 6";

$stmt = $PDO->prepare($sql);
$stmt->execute();
$contar = $stmt->rowCount();

?>
<link rel="stylesheet" type="text/css" href="../assets/css/vagas.css">
<section id="blog" class="container posts" style="margin-top:100px;>

<div class="row">
  <div class="col-md-8">
    <h1 class="title-main">Área de Vagas</h1>

    <?php
    if($contar > 0) :
      $conteudo = '';
      while ($vagas = $stmt->fetch(PDO::FETCH_ASSOC)):

      $descricao = substr($vagas['descricao_vaga'],0,600);

      ?>
      <div class="vagas">
        <div class='col-md-12'>
          <a href='vaga.php?id=<?php echo $posts['id']; ?>'><h3><?php echo $vagas['titulo_vaga']; ?> - <?php echo $vagas['local']; ?></h3></a>
          <p><?php echo $vagas['divulgador']; ?></p><br>
          <p><?php echo strip_tags($descricao); ?></p><hr>
          <button class="btn btn-success">Aplicar Vaga</button>
        </div>
        
    <?php endwhile;
    else : ?>

      <h3>Ainda não há vagas cadastradas!</h3>

    <?php endif; ?>



  </div>
</div>
<link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
<?php

  include("../includes/sidebar.php");

  include("../includes/footer.php");

?>
