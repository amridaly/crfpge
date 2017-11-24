<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:/wamp64/www/CRFPGE/templates/jl_raiseup_free/blueprints/styles/base.yaml',
    'modified' => 1511198868,
    'data' => [
        'name' => 'Base Styles',
        'description' => 'Base styles for the Raiseup theme',
        'type' => 'core',
        'form' => [
            'fields' => [
                'background' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Base Background',
                    'default' => '#ffffff'
                ],
                'text-color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Base Text Color',
                    'default' => '#222222'
                ],
                'text-active-color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Base Text Active Color',
                    'default' => '#232529'
                ]
            ]
        ]
    ]
];
