<?php

session_start();

include('../includes/config.php');
include('../includes/db.php');

if(isset($_POST['cadastrar'])){
  $razao =  trim(strip_tags($_POST['razao']));
  $descricao = trim(strip_tags($_POST['descricao']));
  $endereco =  trim(strip_tags($_POST['endereco']));
  $estado = strtoupper(trim(strip_tags($_POST['estados'])));
  $cidade =  trim(strip_tags($_POST['cidades']));
  $cep = trim(strip_tags($_POST['cep']));
  $email =  trim(strip_tags($_POST['email']));
  $tel = trim(strip_tags($_POST['tel']));
  $tel2 =  trim(strip_tags($_POST['tel2']));
  $token = bin2hex(openssl_random_pseudo_bytes(32));
  $senha = trim(strip_tags(md5(strrev($_POST['senha']))));
  $rep_senha = trim(strip_tags(md5(strrev($_POST['rep_senha']))));

  if($senha != $rep_senha) {
    header('location: cadastro.php?err=' . urldecode('As senhas precisam ser iguais!'));
  } else {
    //CONSULTA SE HÁ CADASTRADA UMA EMPRESA COM O MESMO E-MAIL
  $sql = "SELECT email FROM empresas";
  $resultado = $PDO->prepare($sql);
  $resultado->bindParam(':email',$email, PDO::PARAM_STR);
  $resultado->execute();
  $contar = $resultado->rowCount();

    if($contar > 0) {
      header('location: cadastro.php?err=' . urldecode('Já existe um cadastro com este e-mail!'));
    } else {
    //INSERE A EMPRESA NO BANCO
    $query = "INSERT INTO empresas (razao_social,descricao,endereco,estado,cidade,cep,email,tel,tel2,token,senha) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

    $result = $PDO->prepare($query);
    $result->bindParam(1,$razao, PDO::PARAM_STR);
    $result->bindParam(2,$descricao, PDO::PARAM_STR);
    $result->bindParam(3,$endereco, PDO::PARAM_STR);
    $result->bindParam(4,$estado, PDO::PARAM_STR);
    $result->bindParam(5,$cidade, PDO::PARAM_STR);
    $result->bindParam(6,$cep,PDO::PARAM_STR);
    $result->bindParam(7,$email, PDO::PARAM_STR);
    $result->bindParam(8,$tel, PDO::PARAM_STR);
    $result->bindParam(9,$tel2, PDO::PARAM_STR);
    $result->bindParam(10,$token, PDO::PARAM_STR);
    $result->bindParam(11,$senha, PDO::PARAM_STR);
    $result->execute();

    $mensagem = "<h1>Olá, {$razao}!</h1>";
    $mensagem .= "<p>Obrigado por se cadastrar no nosso sistema de divulgação de vagas.</p>";
    $mensagem .= "<p>Por favor, acesse o link abaixo para validar a sua conta!</p>";
    $mensagem .= "http://localhost/Blog-Programeiros/admin/ativar.php?token={$token}";

    include_once('enviaform.php');

      if($mail->send()) {
        header('location: cadastro.php?success=' . urldecode('Um e-mail de ativação foi enviado!'));
      }
    }
  }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro</title>
    <!-- Imports de libs -->
    <link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>

    <?php if(isset($_GET['success'])) : ?>

      <div class="alerta alerta-sucesso"><?= $_GET['success'] ?></div>

    <?php endif; ?>

    <?php if(isset($_GET['err'])) : ?>

      <div class="alerta alerta-erro"><?= $_GET['err'] ?></div>

    <?php endif; ?>

    <div class="container">
      <div class="card">
        <div class="row">
          <h2 class="col-md-12" style="margin-top:-7px;">Cadastre-se</h2>

          <form action="" method="POST" class="col-md-12">

            <div class="form-group col-md-12">
              <label for="razao">Razão Social :</label>
              <input type="text" class="form-control" id="razao" name="razao" placeholder="Razão Social" required>
            </div>

            <div class="form-group col-md-6">
              <label for="email">E-mail :</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="* E-mail" required>
            </div>

            <div class="form-group col-md-3">
              <label for="tel">Telefone :</label>
              <input type="text" class="form-control telefone" id="tel" name="tel" placeholder="* Telefone" required>
            </div>

            <div class="form-group col-md-3">
              <label for="tel2">Telefone 2 :</label>
              <input type="text" class="form-control telefone" id="tel2" name="tel2" placeholder="Telefone 2" required>
            </div>

            <div class="form-group col-md-6">
              <label for="senha">Senha :</label>
              <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha para acesso" required>
            </div>

            <div class="form-group col-md-6">
              <label for="rep_senha">Repita a senha :</label>
              <input type="password" class="form-control" id="rep_senha" name="rep_senha" placeholder="Repita a senha" required>
            </div>

            <div class="form-group col-md-12">
              <label for="descricao">Descrição :</label>
              <textarea class="form-control" id="descricao" rows="3" name="descricao" placeholder="* Descrição" required></textarea>
            </div>

            <div class="form-group col-md-12">
              <label for="endereco">Rua :</label>
              <input type="text" class="form-control" id="endereco" name="endereco" placeholder="* Rua" required>
            </div>

            <div class="form-group col-md-2">
              <label for="estados">UF :</label>
              <select class="form-control" name="estados" id="estados" required>
                <option value="">-- UF --</option>
              </select>
            </div>

            <div class="form-group col-md-6">
              <label for="cidades">Cidade :</label>
              <select class="form-control" name="cidades" id="cidades" required>
                <option value="">-- Escolha um estado --</option>
              </select>
            </div>

            <div class="form-group col-md-4">
              <label for="cep">CEP :</label>
              <input type="text" class="form-control" id="cep" name="cep" placeholder="* CEP" required>
            </div>

            <input type="submit" class="form-control btn btn-success" name="cadastrar" value="Efetuar Cadastro">

          </form>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
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
    <script>
      $(document).ready(function() {
        $('.alerta').delay(4000).fadeOut('slow');
      });
    </script>
    <script>

    $(document).ready(function() {

      $.getJSON('estados_cidades.json', function (data) {
        var items = [];
        var options = '<option value="">-- UF --</option>';
        $.each(data, function (key, val) {
          options += '<option value="' + val.sigla + '">' + val.nome + '</option>';
        });
        $("#estados").html(options);

        $("#estados").change(function () {

          var options_cidades = '';
          var str = "";

          $("#estados option:selected").each(function () {
            str += $(this).text();
          });

          $.each(data, function (key, val) {
            if(val.nome == str) {
              $.each(val.cidades, function (key_city, val_city) {
                options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
              });
            }
          });
          $("#cidades").html(options_cidades);

        }).change();

      });

    });

  </script>
  </body>
</html>
