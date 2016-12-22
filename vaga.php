<?php

define('TITLE','Post Único');

include('includes/config.php');
include('includes/db.php');

include('includes/navbar.php');

  if(isset($_GET['id'])) {

    $id = $_GET['id'];

  } else {

    echo "<script>location.href='vagas.php'</script>";

  }

  $sql = "SELECT * FROM vagas WHERE id_vaga=:id";

  try {
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);
    $stmt->execute();
  } catch(PDOException $erro) {
    echo $erro;
  }

  while ($vagas = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $id = $vagas["id_vaga"];
    $titulo = $vagas["titulo_vaga"];
    $descricao = $vagas["descricao_vaga"];
    $divulgador = $vagas["divulgador"];
    $local = $vagas["local"];
    $nivel = $vagas["nivel"];
    $tel = $vagas["tel"];
    $tel2 = $vagas["tel2"];
    $email = $vagas["email"];
  }

?>

  <div class="col-md-8">
    <h2 class="main-title"><?php echo $titulo; ?> - <small>v<?php echo $id; ?></small></h2>
    <p><i><?php echo $divulgador . " - " . $local; ?></i></p>
    <br>

    <p>Nivel Hierárquico: <?php echo $nivel; ?></p>
    <p>Requerimentos para a vaga:</p>
    <p><?php echo $descricao; ?></p><br>
    <p>Contato:</p>
    <p>Telefone: <?php echo $tel; ?></p>
    <p><?php if($tel2 == ''){}else{echo "Telefone2: " . $tel2;} ?></p>
    <p>E-mail: <?php echo $email; ?></p>

  </div>

<?php

  include ("includes/sidebar.php");

  include ("includes/footer.php");

?>
