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

  <div class="col-md-8">
    <h1 class="title-main">Área de Vagas</h1>

    <?php
    if($contar > 0) :
      $conteudo = '';
      while ($vagas = $stmt->fetch(PDO::FETCH_ASSOC)):

      $descricao = substr($vagas['descricao_vaga'],0,300);

      ?>
      <div class="vagas">
        <div class='col-md-12'>
          <a href='/Blog-Programeiros/pages/vaga.php?id=<?php echo $vagas['id_vaga']; ?>'><h3><?php echo $vagas['titulo_vaga']; ?> - <?php echo $vagas['local']; ?></h3></a>
          <p><?php echo $vagas['divulgador']; ?></p><br>
          <p><?php echo strip_tags($descricao); ?>...</p><hr>
        </div>
      </div>
    <?php endwhile;
    else : ?>

      <h3>Ainda não há vagas cadastradas!</h3>

    <?php endif; ?>

  </div>
<link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
<?php

  include("../includes/sidebar.php");

  include("../includes/footer.php");

?>
