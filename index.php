<?php

@define(TITLE, "Programeiros | Blog");

include('includes/config.php');
include('includes/db.php');
include('includes/navbar.php');

?>

<div class="col-md-8">
  <h1 class="title-main">Área de Postagens</h1>
    <div class="row">
  <?php

  if(!empty($_GET['pg'])) {
    $pg = $_GET['pg'];
    if(!is_numeric($pg)) {
    echo "<script>location.href='index.php</script>";
    }
  }

  if(isset($pg)) {
      $pg = $_GET['pg'];
  } else {
      $pg = 1;
  }

  $quantidade = 6; // quantidade de resultados por página

  $inicio = ($pg * $quantidade) - $quantidade;

  if(isset($_POST['s'])) {
    $busca = $_POST['s'];
    $query = "SELECT * FROM tb_postagens WHERE titulo LIKE '%$busca%' OR conteudo LIKE '%$busca%' OR categoria LIKE '%$busca%' ORDER BY id";
  } else {
    $query = "SELECT * FROM tb_postagens ORDER BY id DESC LIMIT $inicio, $quantidade";
  }

  $contagem = 1;

  $stmt = $PDO->prepare($query);
  $stmt->execute();
  $contar = $stmt->rowCount();

  $conteudo = '';
  if($contar>0) {
    while ($posts = $stmt->fetch(PDO::FETCH_ASSOC)):

  $conteudo = substr($posts['conteudo'],0,100);

  ?>

  <div class='col-md-6'>
    <div class='thumbnail'>
      <a href='/Blog-Programeiros/pages/post.php?id=<?php echo $posts['id']; ?>'><h3 class="titulo-thumb"><?php echo $posts['titulo']; ?></h3>
      <img src='upload/postagens/<?php echo $posts['imagem'] ?>' alt=''></a>
      <div class='caption'>
        <p><?php echo strip_tags($conteudo); ?>...</p><br>
        <p><a href='/Blog-Programeiros/pages/post.php?id=<?php echo $posts['id']; ?>' class='btn btn-primary pull-right btn-mais' role='button'>Ler Mais</a></p>
      </div>
    </div>
  </div>

  <?php endwhile;

  } else {
      echo "<h3>Não há posts cadastrados!</h3>";
  } 

  if(isset($_POST['s'])) {
    $busca = $_POST['s'];

    $sql = "SELECT * FROM tb_postagens WHERE titulo LIKE '%$busca%' OR conteudo LIKE '%$busca%' OR categoria LIKE '%$busca%'";

  } else {

    $sql = "SELECT * FROM tb_postagens";
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
        echo "<script>location.href='index.php';</script>";
    }
    $links = 5;

  if(isset($i)) {

  } else {
      $i = '1';
  }

  ?>

<div class='col-md-12'>
  <nav aria-label="...">
    <ul class="pager">
      <li><a href="index.php?pg=1">Primeira Página</a></li>


    <!-- PAGINACAO */ -->

    <?php

      if(isset($_GET['pg'])) {
          $num_pg = $_GET['pg'];
      }

      for($i = $pg-$links; $i <= $pg-1; $i++) {
          if($i<=0) {} else { ?>

              <li><a href="index.php?pg=<?php echo $i; ?>"><?php echo $i; ?></a></li>

    <?php } } ?>

      <li><a href="#" class="active<?php echo $i; ?>"><?php echo $pg; ?></a></li>

    <?php

      for($i = $pg+1; $i <= $pg+$links; $i++) {

      if($i>$paginas) { 

      } else { ?>

          <li><a href="index.php?pg=<?php echo $i; ?>" class="active<?php echo $i; ?>"><?php echo $i; ?></a></li>

      <?php } } ?>

      <li><a href="index.php?pg=<?php echo $paginas; ?>">Última Página</a></li>

      </ul>

    </nav>

    <?php } ?>

  </div>

</div>


<?php

  include ("includes/sidebar.php");

  include ("includes/footer.php");

?>
