<?php

  include('includes/navbar.php');

     if(isset($_GET['delete'])) {
        $id_delete = $_GET['delete'];

        $deleta = "DELETE FROM vagas WHERE id_vaga=:id_delete";
            try {
                $result = $PDO->prepare($deleta);
                $result->bindParam(':id_delete',$id_delete, PDO::PARAM_INT);
                $result->execute();
                $contar = $result->rowCount();
                if($contar>0) {
                    echo '<div class="span12"><div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Vaga excluida com sucesso!</strong>
                          </div></div>';
                } else {
                    echo '<div class="span12"><div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert">×</button>
                       <strong>Vaga com este ID não existe ou já foi excluido!</strong>
                   </div></div>';
                }

                } catch(PDOException $erro) {
                    echo $erro;
                }

            }

          ?>

    </div>

          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Lista de Vagas</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th style="white-space: nowrap;"> Nome da Vaga </th>
                    <th style="white-space: nowrap;"> Resumo </th>
                    <th style="white-space: nowrap;"> Divulgador </th>
                    <th style="white-space: nowrap;"> Data de Inclusão </th>
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>
                <?php

                    // PAGINACAO

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

                $quantidade = 6;
                $inicio = ($pg * $quantidade) - $quantidade;

                if(isset($_POST['busca'])) {
                  $busca = $_POST['busca'];

                  $query = "SELECT * FROM vagas WHERE titulo_vaga LIKE '%$busca%' OR descricao_vaga LIKE '%$busca%'";

                } else {

                $query = "SELECT * FROM vagas ORDER BY id_vaga DESC LIMIT $inicio, $quantidade";

              }
                $contagem = 1;

                try {
                    $result = $PDO->prepare($query);
                    $result->execute();
                    $contar = $result->rowCount();
                    if($contar>0) {
                        while ($vaga = $result->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td style="white-space: nowrap;"> <?= $vaga["titulo_vaga"]; ?> </td>
                            <td> <?= substr($vaga["descricao_vaga"],0,200); ?> </td>
                            <td style="white-space: nowrap;"> <?= $vaga["divulgador"]; ?> </td>
                            <td style="white-space: nowrap;"> <?= date('d/m/Y', strtotime($vaga["data_inc"])); ?> </td>
                            <td class="td-actions"><a href="edita_vaga.php?id=<?= $vaga["id_vaga"]; ?>" class="btn btn-small btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a href="vagas.php?pg=<?php echo $pg; ?>&delete=<?= $vaga["id_vaga"]; ?>" onClick='return confirm("Deseja realmente excluir esta vaga?")' class="btn btn-danger btn-small"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                        </tr>
                   <?php endwhile;
                    } else {
                        echo "<tr>
                                 <td colspan='5' style='text-align:center';> Não há vagas cadastradas! </td>
                              </tr>";
                    }

                } catch(PDOException $e) {
                    echo 'Erro:' . $e;
                }
                ?>

                </tbody>
              </table>
            </div>

            <style>

                .paginas {
                    width: 100%;
                    padding: 10px 0;
                    text-align: center;
                    background-color: #fff;
                    height: auto;
                    margin: 10px auto;
                }

                .paginas a {
                    width: auto;
                    padding: 4px 10px;
                    background-color: #eee;
                    color: #333;
                    margin: 0px 2.5px;
                }

                .paginas a:hover {
                    text-decoration: none;
                    background-color: #00ba8b;
                    color: #fff;
                }

                <?php
                    if(isset($_GET['pg'])) {
                        $num_pg = $_GET['pg'];
                    } else {
                        $num_pg = 1;
                    }
                ?>

                .paginas a.ativo<?php echo $num_pg; ?> {
                    background-color: #00ba8b;
                    color: #fff;
                }

            </style>


            <?php
              if(isset($_POST['busca'])) {
                $busca = $_POST['busca'];

                $sql = "SELECT * FROM login WHERE nome LIKE '%$busca%' OR usuario LIKE '%$busca%'";

              } else {

                $sql = "SELECT * FROM login ORDER BY id";

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
                      echo "<script>location.href='vagas.php?pg=$paginas';</script>";
                  }
                  $links = 5;

                  if(isset($i)) {

                  } else {
                      $i = '1';
                  }

            ?>

            <div class="paginas">


                <a href="vagas.php?pg=1">Primeira Página</a>
                <?php
                    if(isset($_GET['pg'])) {
                        $num_pg = $_GET['pg'];
                    }

                    for($i = $pg-$links; $i <= $pg-1; $i++) {
                        if($i<=0) {} else {
                            ?>
                            <a href="vagas.php?pg=<?php echo $i; ?>" class="ativo<?php echo $i; ?>"><?php echo $i; ?></a>

             <?php } } ?>

             <a href="#" class="ativo<?php echo $i; ?>"><?php echo $pg; ?></a>

            <?php
                for($i = $pg+1; $i <= $pg+$links; $i++) {
                    if($i>$paginas) { }
                    else{
                        ?>

                        <a href="vagas.php?pg=<?php echo $i; ?>" class="ativo<?php echo $i; ?>"><?php echo $i; ?></a>

            <?php } } ?>

            <a href="vagas.php?pg=<?php echo $paginas; ?>">Última Página</a>

             </div>

             <?php  } ?>

          </div>
        </div>
      </div>
    </div>

    <?php

    include('includes/footer.php');

    ?>
