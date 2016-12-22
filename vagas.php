<?php

@define(TITLE, "Programeiros | Vagas");

include('includes/config.php');
include('includes/db.php');
include('includes/navbar.php');

?>

<div class="col-md-8">
  <h1 class="title-main">Divulgação de Vagas</h1>
    <div class="row">
  <?php

  if(!empty($_GET['pg'])) {
    $pg = $_GET['pg'];
    if(!is_numeric($pg)) {
    echo "<script>location.href='vagas.php</script>";
    }
  }

  if(isset($pg)) {
      $pg = $_GET['pg'];
  } else {
      $pg = 1;
  }

  $quantidade = 5; // quantidade de resultados por página

  $inicio = ($pg * $quantidade) - $quantidade;

  if(isset($_POST['s'])) {
    $busca = $_POST['s'];
    $query = "SELECT * FROM vagas WHERE titulo_vaga LIKE '%$busca%' OR descricao_vaga LIKE '%$busca%' OR divulgador LIKE '%$busca%' ORDER BY id_vaga";
  } else {
    $query = "SELECT * FROM vagas ORDER BY id_vaga DESC LIMIT $inicio, $quantidade";
  }

  $contagem = 1;

  $stmt = $PDO->prepare($query  );
  $stmt->execute();
  $contar = $stmt->rowCount();

  $conteudo = '';
  if($contar > 0) :
      $conteudo = '';
      while ($vagas = $stmt->fetch(PDO::FETCH_ASSOC)):

      $descricao = substr($vagas['descricao_vaga'],0,300);

      ?>

  <div class="vagas">
          <div class='col-md-12'>
            <a href='vaga.php?id=<?php echo $vagas['id_vaga']; ?>'><h3><?php echo $vagas['titulo_vaga']; ?> - <?php echo $vagas['local']; ?></h3></a>
            <p><i><?php echo $vagas['divulgador']; ?></i></p>
            <p><?php echo strip_tags($descricao); ?>...</p><hr>
          </div>
        </div>
      <?php endwhile;

  else :
      echo "<h3>Não há posts cadastrados!</h3>";
  endif;

  if(isset($_POST['s'])) {
    $busca = $_POST['s'];

    $sql = "SELECT * FROM vagas WHERE titulo_vaga LIKE '%$busca%' OR descricao_vaga LIKE '%$busca%' OR divulgador LIKE '%$busca%' ORDER BY id_vaga";

  } else {

    $sql = "SELECT * FROM vagas";
  }

  try {
    $result = $PDO->prepare($sql);
    $result->execute();
    $totalRegistros = $result->rowCount();
  } catch(PDOException $e) {
      echo 'Erro:' . $e;
  }
  if($totalRegistros <= $quantidade) {

  } else {
    $paginas = ceil($totalRegistros/$quantidade);
    if($pg > $paginas) {
        echo "<script>location.href='vagas.php';</script>";
    }
    $links = 5;

  if(isset($i)) {

  } else {
      $i = '1';
  }

  ?>

<!-- PAGINACAO */ -->
<div class='col-md-12'>
  <nav aria-label="...">
    <ul class="pager">
      <li><a href="vagas.php?pg=1">Primeira Página</a></li>

    <?php

      if(isset($_GET['pg'])) {
          $num_pg = $_GET['pg'];
      }

      for($i = $pg-$links; $i <= $pg-1; $i++) {
          if($i<=0) {} else { ?>

              <li><a href="vagas.php?pg=<?php echo $i; ?>"><?php echo $i; ?></a></li>

    <?php } } ?>

      <li><a href="#" class="active<?php echo $i; ?>"><?php echo $pg; ?></a></li>

    <?php

      for($i = $pg+1; $i <= $pg+$links; $i++) {

      if($i>$paginas) {

      } else { ?>

          <li><a href="vagas.php?pg=<?php echo $i; ?>" class="active<?php echo $i; ?>"><?php echo $i; ?></a></li>

      <?php } } ?>

      <li><a href="vagas.php?pg=<?php echo $paginas; ?>">Última Página</a></li>

      </ul>

    </nav>

    <?php } ?>

  </div>

</div>
</div>

<?php

  include ("includes/sidebar.php");

  include ("includes/footer.php");

?>
