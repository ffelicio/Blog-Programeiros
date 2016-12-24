<?php

define('TITLE','Post Único');

include('includes/config.php');
include('includes/db.php');

include('includes/navbar.php');

  if(!isset($pid)) {
    header('location: /');
  } else {
    $id = $pid;
  }

  $sql = "SELECT * FROM tb_postagens WHERE id=:id";

  try {
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);
    $stmt->execute();
  } catch(PDOException $erro) {
    echo $erro;
  }

  while ($postagem = $stmt->fetch(PDO::FETCH_ASSOC)) {
     $id = $postagem["id"];
     $titulo = $postagem["titulo"];
     $imagem = $postagem["imagem"];
     $usuario = $postagem["usuario"];
     $conteudo = $postagem["conteudo"];
  }

  $sqlUser = "SELECT * FROM login WHERE usuario=:usuario";

    try {
      $stmt2 = $PDO->prepare($sqlUser);
      $stmt2->bindParam(':usuario',$usuario, PDO::PARAM_STR);
      $stmt2->execute();
    } catch(PDOException $erro) {
      echo $erro;
    }

    while ($user = $stmt2->fetch(PDO::FETCH_ASSOC)) {
     $nome = $user["nome"];
     $descricao = $user["descricao"];
     $thumb = $user["thumb"];
  }

?>

  <div class="col-md-8">
    <h1 class="text-center main-title"><?php echo $titulo; ?></h1><br>
    <img src="../upload/postagens/<?php echo $imagem; ?>" alt="" class="img-responsive">

    <br>

    <p><?php echo $conteudo; ?></p>

    <br>
    <hr>
    <br>

    <div class="alert alert-usuario autor">
      <div class="row">
        <div class="col-md-2">
          <img src="../upload/users/<?php echo $thumb; ?>" alt="<?php echo $nome; ?>" class="img-usuario">
        </div>
        <div class="col-md-8">
          <div class="texto-user">
            <h3>por <?php echo $nome; ?></h3>
            <p><?php echo $descricao; ?></p>
          </div>
        </div>
      </div>
    </div>

    <br>
    <hr>
    <br>
    <div id="disqus_thread"></div><br><br><br>
    <script>
        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables */

        var disqus_config = function () {
            this.page.url = 'http://jediazzidev.tk/postagem.php?id=<?php echo $id; ?>';
            this.page.identifier = 'http://jediazzidev.tk/postagem.php?id=<?php echo $id; ?>';
        };

        (function () { // DON'T EDIT BELOW THIS LINE
            var d = document,
                s = d.createElement('script');
            s.src = '//jediazzi.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
  </div>

<?php

  include ("includes/sidebar.php");

  include ("includes/footer.php");

?>
