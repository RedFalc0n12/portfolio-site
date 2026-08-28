# Site de Portfólio / Currículo

Site pessoal em **PHP + HTML5** com fundo preto, seção de **Apresentação** e
seção de **Currículo**, além de um formulário de **Contato** funcional
(processado no servidor em PHP).

## Aviso

este site foi feito com dois propositos 
1- Entender o nivel de complexidade e de qualidade que o PHP pode entregar e exigir em aplicações de medio para alto nivel de experienciaou/conhecimento.

2- criar um site de currículo/portifólio que fosse funcional.

## Como testar localmente

Você precisa do PHP instalado (não abre direto com duplo clique, pois usa `.php`).

```bash
cd portfolio-site
php -S localhost:8000
```

Depois acesse **http://localhost:8000** no navegador.

Alternativas: XAMPP, MAMP, Laragon, ou qualquer hospedagem com suporte a PHP
(a grande maioria das hospedagens compartilhadas tem).

## Como personalizar o conteúdo

Quase tudo o que aparece no site vem de **um único arquivo**:

```
includes/dados.php
```

Edite ali seu nome, cargo, resumo, e-mail, redes sociais, experiências,
formação, habilidades e idiomas. Não é necessário mexer no HTML.

## Estrutura de pastas

```
portfolio-site/
├── index.php                 → página principal (monta as 3 seções)
├── includes/
│   ├── dados.php              → conteúdo do site (edite aqui)
│   ├── funcoes.php            → funções auxiliares (escape, validação do form)
│   ├── header.php              → <head>, menu/índice de navegação
│   └── footer.php              → rodapé e carregamento do JS
├── assets/
│   ├── css/style.css          → toda a estilização (fundo preto, cores, etc.)
│   ├── js/main.js             → menu mobile, aba ativa, animações de rolagem
│   ├── img/                   → coloque suas imagens aqui
│   └── curriculo.pdf          → opcional: se você adicionar este arquivo,
│                                 o botão "Baixar currículo (PDF)" aparece
│                                 automaticamente na seção de Apresentação
└── data/
    └── contatos.log           → gerado automaticamente com as mensagens
                                  recebidas pelo formulário de contato
```

## Sobre o formulário de contato

Por padrão, as mensagens são salvas em `data/contatos.log` (não envia e-mail
de verdade, pois isso depende de um servidor de e-mail configurado). Se quiser
que ele envie e-mails de verdade, troque a função `salvarContato()` em
`includes/funcoes.php` para usar `mail()`, uma API de envio (SendGrid,
Resend, etc.) ou gravar em um banco de dados.

## Identidade visual

O site segue um conceito de "dossiê pessoal": fundo preto, detalhes em
dourado, tipografia da família **IBM Plex** (Serif para títulos, Sans para
texto, Mono para rótulos/metadados) e uma navegação em formato de índice.
Todas as cores e fontes estão centralizadas no topo de `assets/css/style.css`
(bloco `:root`), então dá para trocar a paleta inteira mudando poucas linhas.
