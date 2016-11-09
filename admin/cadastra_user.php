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
                    $nome = trim(strip_tags($_POST['nome']));
                    $email = trim(strip_tags($_POST['email']));
                    $user = trim(strip_tags($_POST['usuario']));
                    $descricao = trim(strip_tags($_POST['descricao']));
                    $senha = trim(strip_tags(md5(strrev($_POST['senha']))));
                    $rep_senha = trim(strip_tags(md5(strrev($_POST['rep_senha']))));
                    $data = date('Y/m/d');

                    if($senha != $rep_senha) {
                        echo '<div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>As senhas não conferem!</strong>
                              </div>';
                    } else {



                    $consulta = "SELECT * FROM login WHERE usuario = :usuario";

                    try {
                            $resultado = $PDO->prepare($consulta);
                            $resultado->bindParam(':usuario',$user, PDO::PARAM_STR);
                            $resultado->execute();
                            $contar = $resultado->rowCount();
                            if($contar>0) {
                                echo '<div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>Já existe um usuário com este nome!</strong>
                                </div>';
                            } else {

                              //INFO IMAGEM
                      		$file 		= $_FILES['img'];
                      		$numFile	= count(array_filter($file['name']));

                      		//PASTA
                      		$folder		= '../upload/users';

                      		//REQUISITOS
                      		$permite 	= array('image/jpeg', 'image/png');
                      		$maxSize	= 1024 * 1024 * 1;

                      		//MENSAGENS
                      		$msg		= array();
                      		$errorMsg	= array(
                      			1 => 'O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini.',
                      			2 => 'O arquivo ultrapassa o limite de tamanho em MAX_FILE_SIZE que foi especificado no formulário HTML',
                      			3 => 'o upload do arquivo foi feito parcialmente',
                      			4 => 'Não foi feito o upload do arquivo'
                      		);

                      		if($numFile <= 0){
                      			echo '<div class="alert alert-danger">
                      						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      						Selecione uma imagem para a postagem!
                      					</div>';
                      		}
                      		else if($numFile > 1){
                      			echo '<div class="alert alert-danger">
                      						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      						Você ultrapassou o limite de upload. Selecione apenas 1 foto e tente novamente!
                      					</div>';
                      		}else{
                      			for($i = 0; $i < $numFile; $i++){
                      				$name 	= $file['name'][$i];
                      				$type	= $file['type'][$i];
                      				$size	= $file['size'][$i];
                      				$error	= $file['error'][$i];
                      				$tmp	= $file['tmp_name'][$i];

                      				$extensao = @end(explode('.', $name));
                      				$novoNome = rand().".$extensao";

                      				if($error != 0)
                      					$msg[] = "<b>$name :</b> ".$errorMsg[$error];
                      				else if(!in_array($type, $permite))
                      					$msg[] = "<b>$name :</b> Erro imagem não suportada!";
                      				else if($size > $maxSize)
                      					$msg[] = "<b>$name :</b> Erro imagem ultrapassa o limite de 5MB";
                      				else{

                      					if(move_uploaded_file($tmp, $folder.'/'.$novoNome)){
                      						//$msg[] = "<b>$name :</b> Upload Realizado com Sucesso!";

                                              $insert = "INSERT INTO login (nome,email,usuario,thumb,descricao,senha,data) VALUES (:nome,:email,:usuario,:thumb,:descricao,:senha,:data)";

                                          try {
                                              $result = $PDO->prepare($insert);
                                              $result->bindParam(':nome',$nome, PDO::PARAM_STR);
                                              $result->bindParam(':email',$email, PDO::PARAM_STR);
                                              $result->bindParam(':usuario',$user, PDO::PARAM_STR);
                                              $result->bindParam(':thumb',$novoNome, PDO::PARAM_STR);
                                              $result->bindParam(':descricao',$descricao, PDO::PARAM_STR);
                                              $result->bindParam(':senha',$senha, PDO::PARAM_STR);
                                              $result->bindParam(':data',$data, PDO::PARAM_STR);
                                              $result->execute();
                                              $contar = $result->rowCount();
                                              if($contar>0) {
                                                  echo '<div class="alert alert-success">
                                                  <button type="button" class="close" data-dismiss="alert">x</button>
                                                  <strong>Post incluido com Sucesso!</strong>
                                                  </div>';
                                              } else {
                                                  echo '<div class="alert alert-danger">
                                                  <button type="button" class="close" data-dismiss="alert">x</button>
                                                  <strong>Erro ao cadastrar post!</strong>
                                                  </div>';
                                              }

                                          } catch(PDOException $e) {
                                              echo 'Erro:' . $e;
                                              }

                      					}else
                      						$msg[] = "<b>$name :</b> Desculpe! Ocorreu um erro...";

                      				}

                      				foreach($msg as $pop)
                      				echo '';
                      					//echo $pop.'<br>';
                      			}
                      		}

                        }

                      } catch(PDOException $e) {
                          echo 'Erro:' . $e;
                          }

                        }
                      }

                  /*      $insert = "INSERT INTO login (nome,email,usuario,descricao,senha,data) VALUES (:nome,:email,:usuario,:descricao,:senha,:data)";

                        try {
                            $result = $PDO->prepare($insert);
                            $result->bindParam(':nome',$nome, PDO::PARAM_STR);
                            $result->bindParam(':email',$email, PDO::PARAM_STR);
                            $result->bindParam(':usuario',$usuario, PDO::PARAM_STR);
                            $result->bindParam(':descricao',$descricao, PDO::PARAM_STR);
                            $result->bindParam(':senha',$senha, PDO::PARAM_INT);
                            $result->bindParam(':data',$data, PDO::PARAM_STR);
                            $result->execute();
                            $contar = $result->rowCount();
                            if($contar>0) {
                                echo '<div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>Usuário incluido com Sucesso!</strong>
                                </div>';
                            } else {
                                echo '<div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>Erro ao cadastrar usuário!</strong>
                                </div>';
                            }

                        } catch(PDOException $e) {
                            echo 'Erro:' . $e;
                            }

                        }// encerra

                    } catch(PDOException $e) {
                        echo 'Erro:' . $e;
                    }*/


                ?>

                    <br>

                    <form id="edit-profile" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <fieldset>

                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do usuário" required>
                            </div>

                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail do usuário" required>
                            </div>

                            <div class="form-group">
                                <label for="usuario">Usuário:</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario"  placeholder="Username" required>
                            </div>

                            <div class="form-group">
                                <label for="imagem">Thumb para o user:</label>
                                    <input type="file" class="form-control" id="imagem" name="img[]">
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição:</label>
                                    <input type="text" class="form-control" id="descricao" name="descricao"  placeholder="Descrição" required>
                            </div>

                            <div class="form-group">
                                <label for="senha">Senha:</label>
                                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha do usuário" required>
                            </div>

                            <div class="form-group">
                                <label for="rep_senha">Repete Senha:</label>
                                    <input type="password" class="form-control" id="rep_senha" name="rep_senha" placeholder="Repita a Senha do usuário" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="cadastrar" class="btn btn-primary">Incluir Usuário</button>
                                <button type="reset" class="btn btn-danger">Cancelar</button>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include('includes/footer.php');

?>
