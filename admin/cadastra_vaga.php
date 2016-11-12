<?php include('includes/navbar.php'); ?>

</div><!-- row -->

          <div class="widget widget-table action-table">
            	<div class="widget-header">
                    <i class="icon-file"></i>
                    <h3>Cadastra Nova Vaga</h3>
                </div> <!-- /widget-header -->

                <div class="widget-content">

                <?php

                if(isset($_POST['cadastrar'])) {
                  $titulo = trim(strip_tags($_POST['titulo']));
                  $descricao = trim($_POST['descricao']);
                  $local = trim(strip_tags($_POST['local']));
                  $nivel = trim(strip_tags($_POST['nivel']));
                  $divulgador = trim(strip_tags($_POST['divulgador']));
                  $tel = trim(strip_tags($_POST['tel']));
                  $tel2 = trim(strip_tags($_POST['tel2']));
                  $email = trim(strip_tags($_POST['email']));
                  $data_inc = date('Y/m/d');
                  $data_exp = date('Y/m/d', strtotime('+90 days', strtotime($data_inc)));

                  $insert = "INSERT INTO vagas (titulo_vaga,descricao_vaga,divulgador,local,nivel,tel,tel2,email,data_inc,data_exp) VALUES (?,?,?,?,?,?,?,?,?,?)";

                  try {
                      $result = $PDO->prepare($insert);
                      $result->bindParam(1,$titulo, PDO::PARAM_STR);
                      $result->bindParam(2,$descricao, PDO::PARAM_STR);
                      $result->bindParam(3,$divulgador, PDO::PARAM_STR);
                      $result->bindParam(4,$local, PDO::PARAM_STR);
                      $result->bindParam(5,$nivel, PDO::PARAM_STR);
                      $result->bindParam(6,$tel, PDO::PARAM_STR);
                      $result->bindParam(7,$tel2, PDO::PARAM_STR);
                      $result->bindParam(8,$email, PDO::PARAM_STR);
                      $result->bindParam(9,$data_inc, PDO::PARAM_STR);
                      $result->bindParam(10,$data_exp, PDO::PARAM_STR);
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
                            <label for="divulgador">Divulgador:</label>
                            <input type="text" class="form-control" id="divulgador" name="divulgador" placeholder="Empresa Anunciante" required autofocus>
                          </div>

                          <div class="form-group">
                            <label for="titulo">Titulo:</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo da vaga" required autofocus>
                          </div>

                          <div class="form-group">
                            <label for="local">Local:</label>
                            <input type="text" class="form-control" id="local" name="local" placeholder="Local de trabalho" required>
                          </div>

                          <div class="form-group">
                            <label for="tel">Telefone:</label>
                            <input type="tel" class="form-control telefone" id="tel" name="tel" placeholder="Telefone" required>
                          </div>

                          <div class="form-group">
                            <label for="tel2">Telefone 2:</label>
                            <input type="tel" class="form-control telefone" id="tel2" name="tel2" placeholder="Telefone 2">
                          </div>

                          <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail para contato" required>
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
                            <label for="descricao">Descrição da vaga:</label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="8"></textarea>
                          </div>

                          <div class="form-group">
                            <button type="submit" name="cadastrar" class="btn btn-primary">Incluir Vaga</button>
                            <button type="reset" class="btn btn-danger">Cancelar</button>
                          </div> <!-- /form-actions -->

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script src="http://digitalbush.com/wp-content/uploads/2014/10/jquery.maskedinput.js"></script>
<script type="text/javascript">
jQuery("input.telefone")
        .mask("(99) 9999-9999?9")
        .focusout(function (event) {
            var target, phone, element;
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;
            phone = target.value.replace(/\D/g, '');
            element = $(target);
            element.unmask();
            if(phone.length > 10) {
                element.mask("(99) 99999-999?9");
            } else {
                element.mask("(99) 9999-9999?9");
            }
        });
</script>

<script src="../assets/js/nicEdit.js"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function () {
        nicEditors.allTextAreas()
    });
</script>

<?php

include('includes/footer.php');

?>
