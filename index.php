<?php

require "vendor/autoload.php";
$url = new \DRouter\App();
$url->render->setViewsFolder('./');

$url->get('/', function() {
  $this->render->load("home.php", [
    "" => ""
  ]);
});

$url->get('/quem-somos', function() {
  $this->render->load("quem-somos.php", [
    "" => ""
  ]);
});

$url->get('/vagas', function() {
  $this->render->load("vagas.php", [
    "" => ""
  ]);
});

$url->get('/vagas/:pagina', function($pagina) {
  $this->render->load("vagas.php", [
    "pg" => $pagina
  ]);
});

$url->get('/vagas/:pagina/:vid', function($pagina, $vid) {
  if ($pagina == 0) {
    $this->render->load("vagas.php", [
      "vid" => $vid
    ]);
  }else {
    $this->render->load("vagas.php", [
      "pg" => $pagina,
      "vid" => $vid
    ]);
  }
});

$url->get('/vaga', function() {
  $this->render->load("vaga.php", [
    "" => ""
  ]);
});

$url->get('/vaga/:vid', function($vid) {
  $this->render->load("vaga.php", [
    "id" => $vid
  ]);
});

$url->get('/contato', function() {
  $this->render->load("contato.php", [
    "" => ""
  ]);
});

$url->get('/categoria', function() {
  header("Location: /");
});

$url->get('/categoria/:id', function($id) {
  $this->render->load("categoria.php", [
    "ctg" => $id
  ]);
});

$url->get('/categoria/:id/:pagina', function($id, $pagina) {
  $this->render->load("categoria.php", [
    "ctg" => $id,
    "pg" => $pagina
  ]);
});

$url->get('/post/:id', function($id) {
  $this->render->load("post.php", [
    "pid" => $id
  ]);
});

// URL(s) em desenvolvimento á baixo

$url->get('/cadastro', function() {
  header("Location: /");
});

$url->get('/cadastro/:eos', function($eos) {
  if ($eos == "err") {
    $this->render->load("cadastro.php", [
      "err" => "Erro ao enviar mensagem!"
    ]);
  }elseif ($eos == "success") {
    $this->render->load("cadastro.php", [
      "success" => "Um e-mail de ativação foi enviado!"
    ]);
  }
});

// Fim da(s) URL(s) em desenvolvimento

// URL(s) á baixo são para acessar o(s) teste(s) feito(s) por mim(Meratsunosu)

$url->get('/developers_tests/test1', function() {
  $this->render->load("tests_by_developers/testURL.php", [
    "" => ""
  ]);
});

$url->get('/developers_tests/test1/:var', function($var) {
  $this->render->load("tests_by_developers/testURL.php", [
    "testdinamicvar" => $var
  ]);
});

// Fim das URLs de teste

$url->get('/:pagina', function($pagina) {
  $this->render->load("home.php", [
    "pg" => $pagina
  ]);
});

$url->run();
