<?php

/**
 * Funções auxiliares usadas em index.php.
 */

/** Escapa uma string para saída segura em HTML. */
function e(?string $valor): string
{
    return htmlspecialchars($valor ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Valida os dados enviados pelo formulário de contato.
 * Retorna um array com 'erros' (lista de mensagens) e 'dados' (valores tratados).
 */
function validarContato(array $post): array
{
    $nome     = trim($post['nome'] ?? '');
    $email    = trim($post['email'] ?? '');
    $mensagem = trim($post['mensagem'] ?? '');

    $erros = [];
    if ($nome === '') {
        $erros[] = 'Informe seu nome.';
    }
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = 'Informe um e-mail válido.';
    }
    if ($mensagem === '') {
        $erros[] = 'Escreva uma mensagem.';
    }

    return [
        'erros' => $erros,
        'dados' => ['nome' => $nome, 'email' => $email, 'mensagem' => $mensagem],
    ];
}

/**
 * Grava uma mensagem de contato em data/contatos.log.
 * Em produção, pode-se trocar isto por mail(), um envio via API
 * ou gravação em banco de dados.
 */
function salvarContato(array $dados): bool
{
    $pasta = __DIR__ . '/../data';

    if (!is_dir($pasta) && !@mkdir($pasta, 0755, true) && !is_dir($pasta)) {
        // Não conseguiu criar a pasta "data" (permissão negada, etc.)
        error_log('[portfolio-site] Falha ao criar a pasta de dados: ' . $pasta);
        return false;
    }

    if (!is_writable($pasta)) {
        error_log('[portfolio-site] A pasta de dados existe, mas não tem permissão de escrita: ' . $pasta);
        return false;
    }

    $linha = sprintf(
        "[%s] %s <%s>: %s%s",
        date('Y-m-d H:i:s'),
        $dados['nome'],
        $dados['email'],
        str_replace(["\r", "\n"], ' ', $dados['mensagem']),
        PHP_EOL
    );

    $resultado = @file_put_contents($pasta . '/contatos.log', $linha, FILE_APPEND | LOCK_EX);

    if ($resultado === false) {
        error_log('[portfolio-site] Falha ao gravar em: ' . $pasta . '/contatos.log');
        return false;
    }

    return true;
}
