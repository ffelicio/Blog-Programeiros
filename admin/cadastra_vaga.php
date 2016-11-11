<?php include('includes/navbar.php'); ?>

</div><!-- row -->

          <div class="widget widget-table action-table">
            	<div class="widget-header">
                    <i class="icon-file"></i>
                    <h3>Cadastra Novo Usuário</h3>
                </div> <!-- /widget-header -->

                <div class="widget-content">

                <?php

                if(isset($_POST['cadastrar'])) {
                  $titulo = trim(strip_tags($_POST['titulo']));
                  $descricao = trim($_POST['descricao']);
                  $local = trim(strip_tags($_POST['local']));
                  $nivel = trim(strip_tags($_POST['nivel']));
                  $data_inc = date('Y/m/d');
                  $data_exp = date('Y/m/d', strtotime('+90 days', strtotime($data_inc)));

                  $insert = "INSERT INTO vagas (titulo_vaga,descricao_vaga,divulgador,local,nivel,data_inc,data_exp) VALUES (:titulo_vaga,:descricao_vaga,:divulgador,:local,:nivel,:data_inc,:data_exp)";

                  try {
                      $result = $PDO->prepare($insert);
                      $result->bindParam(':titulo_vaga',$titulo, PDO::PARAM_STR);
                      $result->bindParam(':descricao_vaga',$descricao, PDO::PARAM_STR);
                      $result->bindParam(':divulgador',$nomeUsuario, PDO::PARAM_STR);
                      $result->bindParam(':local',$local, PDO::PARAM_STR);
                      $result->bindParam(':nivel',$nivel, PDO::PARAM_STR);
                      $result->bindParam(':data_inc',$data_inc, PDO::PARAM_STR);
                      $result->bindParam(':data_exp',$data_exp, PDO::PARAM_STR);
                      $result->execute();
                      $contar = $result->rowCount();
                      if($contar>0) {
                          echo '<div class="alert alert-success">
                                  <button type="button" class="close" data-dismiss="alert">x</button>
                                  <strong>Vaga incluida com Sucesso!</strong>
                                </div>';
                      } else {
                          echo '<div class="alert alert-danger">
                                  <button type="button" class="close" data-dismiss="alert">x</button>
                                  <strong>Erro ao cadastrar vaga!</strong>
                                </div>';
                      }

                    } catch(PDOException $e) {
                      echo 'Erro:' . $e;
                    }
                }
              ?>

                    <br>

                    <form id="edit-profile" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <fieldset>

                            <div class="form-group">
                                <label for="titulo">Titulo:</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo da vaga" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição da vaga:</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="8"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="local">Local:</label>
                                <input type="text" class="form-control" id="local" name="local" placeholder="Local de trabalho" required>
                            </div>

                            <div class="form-group">
                                <label for="nivel">Nivel Hierárquico:</label>
                                <select class="form-control" name="nivel" id="nivel">
                                  <option value="Analista Junior">Analista Junior</option>
                                  <option value="Analista Pleno">Analista Pleno</option>
                                  <option value="Analista Senior">Analista Senior</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="cadastrar" class="btn btn-primary">Incluir Usuário</button>
                                <button type="reset" class="btn btn-danger">Cancelar</button>
                            </div> <!-- /form-actions -->

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/nicEdit.js"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function () {
        nicEditors.allTextAreas()
    });
</script>

<?php

include('includes/footer.php');

?>
