<?php

  include('includes/navbar.php');

    // RECUPERA OS DADOS
    if(!isset($_GET['id'])) {
        header('Location: vagas.php');
        exit();
    }
    $id = $_GET['id'];
    $select = 'SELECT * FROM vagas WHERE id_vaga=:id';

    try {
        $resultado = $PDO->prepare($select);
        $resultado->bindParam(':id',$id,PDO::PARAM_INT);
        $resultado->execute();
        $contar = $resultado->rowCount();
        if($contar>0) {
            while($mostra = $resultado->FETCH(PDO::FETCH_ASSOC)) {
                $idPost = $mostra['id_vaga'];
                $titulo = $mostra['titulo_vaga'];
                $descricao = $mostra['descricao_vaga'];
                $nivel = $mostra['nivel'];
                $local = $mostra['local'];
                $divulgador = $mostra['divulgador'];
                $tel = $mostra['tel'];
                $tel2 = $mostra['tel2'];
                $email = $mostra['email'];
            }

        } else {

            echo '<div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      Não há dados cadastratos com o ID informado!
                  </div>';
            exit();

          }

        } catch(PDOException $e) {
            echo 'Erro:' . $e;
        }

      ?>

     </div><!-- row -->

          <div class="widget widget-table action-table">
            	<div class="widget-header">
                    <i class="icon-file"></i>
                    <h3>Edita Vaga</h3>
                </div> <!-- /widget-header -->

                <div class="widget-content">

                <?php
                    //ATUALIZA POST
                if(isset($_POST['atualiza'])) {
                    $titulo_up = trim(strip_tags($_POST['titulo']));
                    $descricao_up = trim($_POST['descricao']);
                    $local_up = trim(strip_tags($_POST['local']));
                    $nivel_up = trim(strip_tags($_POST['nivel']));
                    $divul_up = trim(strip_tags($_POST['divulgador']));
                    $tel_up = trim(strip_tags($_POST['tel']));
                    $tel2_up = trim(strip_tags($_POST['tel2']));
                    $email_up = trim(strip_tags($_POST['email']));

                    $update = 'UPDATE vagas SET titulo_vaga=:titulo_vaga, divulgador=:divulgador, descricao_vaga=:descricao_vaga, local=:local, nivel=:nivel, tel=:tel, tel2=:tel2, email=:email WHERE id_vaga=:id';

                    try {
                        $result = $PDO->prepare($update);
                        $result->bindParam(':titulo_vaga',$titulo_up, PDO::PARAM_STR);
                        $result->bindParam(':descricao_vaga',$descricao_up, PDO::PARAM_STR);
                        $result->bindParam(':local',$local_up, PDO::PARAM_STR);
                        $result->bindParam(':divulgador',$divul_up, PDO::PARAM_STR);
                        $result->bindParam(':nivel',$nivel_up, PDO::PARAM_STR);
                        $result->bindParam(':tel',$tel_up, PDO::PARAM_STR);
                        $result->bindParam(':tel2',$tel2_up, PDO::PARAM_STR);
                        $result->bindParam(':email',$email_up, PDO::PARAM_STR);
                        $result->bindParam(':id',$id, PDO::PARAM_INT);
                        $result->execute();
                        $contar = $result->rowCount();
                        if($contar>0) {
                            echo '<div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Vaga alterada com Sucesso!</strong>
                                  </div>';
                        } else {
                            echo '<div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Erro ao alterar!</strong>
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

                          <fieldset>

                            <div class="form-group">
                                <label for="divulgador">Divulgador:</label>
                                <input type="text" class="form-control" id="divulgador" name="divulgador" placeholder="Empresa Anunciante" value="<?php echo $divulgador; ?>" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="titulo">Titulo:</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo da vaga" value="<?php echo $titulo; ?>" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição da vaga:</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="8" ><?php echo $descricao; ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="local">Local:</label>
                                <input type="text" class="form-control" id="local" name="local" placeholder="Local de trabalho" value="<?php echo $local; ?>" required>
                            </div>

                            <div class="form-group">
                              <label for="tel">Telefone:</label>
                              <input type="tel" class="form-control telefone" id="tel" name="tel" placeholder="Telefone" value="<?php echo $tel; ?>" required>
                            </div>

                            <div class="form-group">
                              <label for="tel2">Telefone 2:</label>
                              <input type="tel" class="form-control telefone" id="tel2" name="tel2" placeholder="Telefone 2" value="<?php echo $tel2; ?>">
                            </div>

                            <div class="form-group">
                              <label for="email">E-mail:</label>
                              <input type="email" class="form-control" id="email" name="email" placeholder="E-mail para contato" value="<?php echo $email; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="nivel">Nivel Hierárquico:</label>
                                <select class="form-control" name="nivel" id="nivel">
                                  <option value="Analista Junior" <?php if($nivel == 'Analista Junior'){echo 'selected';} ?>>Analista Junior</option>
                                  <option value="Analista Pleno" <?php if($nivel == 'Analista Pleno'){echo 'selected';} ?>>Analista Pleno</option>
                                  <option value="Analista Senior" <?php if($nivel == 'Analista Senior'){echo 'selected';} ?>>Analista Senior</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="atualiza" class="btn btn-primary">Altera Vaga</button>
                                <button type="reset" class="btn btn-danger">Cancelar</button>
                            </div>

                          </fieldset>

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
