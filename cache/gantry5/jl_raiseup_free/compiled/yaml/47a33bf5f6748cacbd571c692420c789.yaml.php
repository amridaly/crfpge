<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:/wamp64/www/CRFPGE/templates/jl_raiseup_free/blueprints/styles/header.yaml',
    'modified' => 1511198868,
    'data' => [
        'name' => 'Header Styles',
        'description' => 'Header styles for the Raiseup theme',
        'type' => 'section',
        'form' => [
            'fields' => [
                'background' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Background',
                    'default' => '#072235'
                ],
                'text-color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Text',
                    'default' => '#d5d5d5'
                ]
            ]
        ]
    ]
];
