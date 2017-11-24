<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:/wamp64/www/CRFPGE/templates/jl_raiseup_free/blueprints/styles/accent.yaml',
    'modified' => 1511198868,
    'data' => [
        'name' => 'Accent Colors',
        'description' => 'Accent colors for the Raiseup theme',
        'type' => 'core',
        'form' => [
            'fields' => [
                'color-1' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Accent Color 1',
                    'default' => '#072235'
                ],
                'color-2' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Accent Color 2',
                    'default' => '#0d70b7'
                ]
            ]
        ]
    ]
];
