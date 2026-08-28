<?php

/**
 * Dados do site — edite este arquivo para personalizar o conteúdo.
 * Tudo o que aparece no site (nome, textos, experiências, etc.)
 * vem daqui. Não é necessário mexer no HTML para atualizar o conteúdo.
 */

return [
    'pessoa' => [
        'nome'            => 'Felipe Gijsen Downs',
        'cargo'           => 'Aluno / Análise e Desenvolvimento de Sistemas',
        'registro'        => '001',
        'localizacao'     => 'Rio de Janeiro, RJ',
        'disponibilidade' => 'Disponível para novos projetos',
        'resumo'          => 'Sou um estudante de Análise e Desenvolvimento de Sistemas (ADS) com paixão por tecnologia e desenvolvimento de software. Estou sempre em busca de aprender novas habilidades e aprimorar meus conhecimentos na área de TI. Tenho experiência em projetos acadêmicos e pessoais, e estou aberto a oportunidades que me permitam crescer profissionalmente.',
        'email'    => 'felipegijsen12@gmail.com',
        'telefone' => '(21) 00000000',
        'redes'    => [
            ['label' => 'LinkedIn', 'url' => 'https://www.linkedin.com/in/felipe-g-downs/'],
            ['label' => 'GitHub',   'url' => 'https://github.com/RedFalc0n12'],
        ],
    ],

    'experiencias' => [
        [
            'periodo'   => '2023 — 2024',
            'cargo'     => 'Soldado - EB',
            'empresa'   => 'Exército Brasiléiro',
            'local'     => 'CMRJ',
            'descricao' => 'Soldado seção de informatica, atribuições manutenção, atendimento, e atuar no quartel de forma geral',
        ],
    ],

    'formacao' => [
        [
            'periodo'      => '2019 — 2021',
            'curso'        => 'Tecnico em Eventos',
            'instituicao'  => 'Faetec Adolpho Bloch',
        ],
        [
            'periodo' => '2024 — atual',
            'curso'   => 'Análise e Desenvolvimento de Sistemas',
            'instituicao' => 'Unicarioca'
        ]
    ],

    'habilidades' => [
        'Técnicas'    => ['Logica de Programação', 'Banco de dados Conceitual', 'Python'],
        'Ferramentas' => ['VScode', 'GIT', 'Azure Foundry'],
    ],

    'idiomas' => [
        ['idioma' => 'Português', 'nivel' => 'Nativo'],
        ['idioma' => 'Inglês',    'nivel' => 'básico'],
    ],
];
