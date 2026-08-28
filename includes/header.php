<?php
/** @var array $dados */
$pessoa = $dados['pessoa'];
?><!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($pessoa['nome']) ?> — <?= e($pessoa['cargo']) ?></title>
<meta name="description" content="<?= e($pessoa['resumo']) ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:wght@400;500;600&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<a class="pular-conteudo" href="#conteudo">Pular para o conteúdo</a>

<nav class="indice" aria-label="Índice de seções">
  <div class="indice__topo">
    <span class="indice__marca">Nº <?= e($pessoa['registro']) ?></span>
    <button class="indice__alternar" id="botaoMenu" type="button" aria-expanded="false" aria-controls="indiceLista">
      <span></span><span></span><span></span>
      <span class="sr-only">Abrir menu</span>
    </button>
  </div>
  <ul id="indiceLista">
    <li><a href="#apresentacao" data-secao="apresentacao">01 · Apresentação</a></li>
    <li><a href="#curriculo" data-secao="curriculo">02 · Currículo</a></li>
    <li><a href="#contato" data-secao="contato">03 · Contato</a></li>
  </ul>
</nav>

<main id="conteudo">
