<?php
session_start();

$dados = require __DIR__ . '/includes/dados.php';
require __DIR__ . '/includes/funcoes.php';

// --- Processa o envio do formulário de contato (PRG: Post/Redirect/Get) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['acao'] ?? '') === 'contato') {
  $resultado = validarContato($_POST);

  if (empty($resultado['erros'])) {
    salvarContato($resultado['dados']);
    $_SESSION['contato_enviado'] = true;
  } else {
    $_SESSION['contato_erros'] = $resultado['erros'];
    $_SESSION['contato_dados'] = $resultado['dados'];
  }

  header('Location: index.php#contato');
  exit;
}

// --- Prepara a mensagem de retorno (sucesso ou erro) após o redirecionamento ---
$feedback = null;
if (isset($_SESSION['contato_enviado'])) {
  $feedback = ['tipo' => 'sucesso', 'texto' => 'Mensagem enviada com sucesso. Obrigado pelo contato!'];
  unset($_SESSION['contato_enviado']);
} elseif (isset($_SESSION['contato_erros'])) {
  $feedback = ['tipo' => 'erro', 'lista' => $_SESSION['contato_erros']];
  unset($_SESSION['contato_erros']);
}

$valoresAntigos = $_SESSION['contato_dados'] ?? ['nome' => '', 'email' => '', 'mensagem' => ''];
unset($_SESSION['contato_dados']);

$pessoa = $dados['pessoa'];

// Só mostra o botão de baixar currículo se o arquivo realmente existir.
$caminhoCurriculoPdf = __DIR__ . '/assets/curriculo.pdf';
$temCurriculoPdf     = is_file($caminhoCurriculoPdf);

require __DIR__ . '/includes/header.php';
?>

<!-- ================= APRESENTAÇÃO ================= -->
<section id="apresentacao" class="secao capa">
  <p class="rotulo">Dossiê pessoal</p>
  <img class="capa__img" ; src="assets/img/eclipse_perfil_SF.png" alt="">
  <h1 class="capa__nome"><?= e($pessoa['nome']) ?></h1>
  <p class="capa__cargo"><?= e($pessoa['cargo']) ?></p>
  <p class="capa__resumo"><?= e($pessoa['resumo']) ?></p>

  <dl class="capa__campos">
    <div>
      <dt>Localização</dt>
      <dd><?= e($pessoa['localizacao']) ?></dd>
    </div>
    <div>
      <dt>Status</dt>
      <dd><?= e($pessoa['disponibilidade']) ?></dd>
    </div>
    <div>
      <dt>Contato</dt>
      <dd><a href="mailto:<?= e($pessoa['email']) ?>"><?= e($pessoa['email']) ?></a></dd>
    </div>
  </dl>

  <div class="capa__acoes">
    <?php foreach ($pessoa['redes'] as $rede): ?>
      <a class="botao botao--linha" href="<?= e($rede['url']) ?>" target="_blank" rel="noopener">
        <?= e($rede['label']) ?>
      </a>
    <?php endforeach; ?>

    <?php if ($temCurriculoPdf): ?>
      <a class="botao botao--cheio" href="assets/curriculo.pdf" download>
        Baixar currículo (PDF)
      </a>
    <?php endif; ?>
  </div>
</section>

<!-- ================= CURRÍCULO ================= -->
<section id="curriculo" class="secao">
  <p class="rotulo">02 · Registro profissional</p>
  <h2 class="secao__titulo">Currículo</h2>

  <div class="bloco">
    <h3 class="bloco__titulo">Experiência</h3>
    <?php foreach ($dados['experiencias'] as $exp): ?>
      <article class="registro">
        <p class="registro__periodo"><?= e($exp['periodo']) ?></p>
        <div class="registro__conteudo">
          <h4><?= e($exp['cargo']) ?></h4>
          <p class="registro__meta"><?= e($exp['empresa']) ?> · <?= e($exp['local']) ?></p>
          <p class="registro__descricao"><?= e($exp['descricao']) ?></p>
        </div>
      </article>
    <?php endforeach; ?>
  </div>

  <div class="bloco">
    <h3 class="bloco__titulo">Formação</h3>
    <?php foreach ($dados['formacao'] as $form): ?>
      <article class="registro">
        <p class="registro__periodo"><?= e($form['periodo']) ?></p>
        <div class="registro__conteudo">
          <h4><?= e($form['curso']) ?></h4>
          <p class="registro__meta"><?= e($form['instituicao']) ?></p>
        </div>
      </article>
    <?php endforeach; ?>
  </div>

  <div class="bloco bloco--duas-colunas">
    <div>
      <h3 class="bloco__titulo">Habilidades</h3>
      <?php foreach ($dados['habilidades'] as $categoria => $itens): ?>
        <p class="grupo__titulo"><?= e($categoria) ?></p>
        <ul class="etiquetas">
          <?php foreach ($itens as $item): ?>
            <li><?= e($item) ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endforeach; ?>
    </div>

    <div>
      <h3 class="bloco__titulo">Idiomas</h3>
      <ul class="lista-simples">
        <?php foreach ($dados['idiomas'] as $idioma): ?>
          <li><span><?= e($idioma['idioma']) ?></span><span
              class="registro__meta"><?= e($idioma['nivel']) ?></span></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<!-- ================= CONTATO ================= -->
<section id="contato" class="secao">
  <p class="rotulo">03 · Fale comigo</p>
  <h2 class="secao__titulo">Contato</h2>

  <?php if ($feedback): ?>
    <div class="aviso aviso--<?= e($feedback['tipo']) ?>" role="status">
      <?php if ($feedback['tipo'] === 'sucesso'): ?>
        <p><?= e($feedback['texto']) ?></p>
      <?php else: ?>
        <ul>
          <?php foreach ($feedback['lista'] as $erro): ?>
            <li><?= e($erro) ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <div class="contato__grade">
    <form class="formulario" method="post" action="index.php#contato" novalidate>
      <input type="hidden" name="acao" value="contato">

      <label for="nome">Nome</label>
      <input type="text" id="nome" name="nome" value="<?= e($valoresAntigos['nome']) ?>" required>

      <label for="email">E-mail</label>
      <input type="email" id="email" name="email" value="<?= e($valoresAntigos['email']) ?>" required>

      <label for="mensagem">Mensagem</label>
      <textarea id="mensagem" name="mensagem" rows="5" required><?= e($valoresAntigos['mensagem']) ?></textarea>

      <button type="submit" class="botao botao--cheio">Enviar mensagem</button>
    </form>

    <div class="contato__direto">
      <p class="grupo__titulo">Contato direto</p>
      <p><a href="mailto:<?= e($pessoa['email']) ?>"><?= e($pessoa['email']) ?></a></p>
      <?php foreach ($pessoa['redes'] as $rede): ?>
        <p><a href="<?= e($rede['url']) ?>" target="_blank" rel="noopener"><?= e($rede['label']) ?></a></p>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>