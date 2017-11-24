<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:\\wamp64\\www\\CRFPGE/templates/jl_raiseup_free/particles/offcanvas-toggle.yaml',
    'modified' => 1511198869,
    'data' => [
        'name' => 'Offcanvas Toggle',
        'description' => 'Display Offcanvas Toggle button.',
        'type' => 'particle',
        'configuration' => [
            'caching' => [
                'type' => 'static'
            ]
        ],
        'form' => [
            'fields' => [
                'enabled' => [
                    'type' => 'input.checkbox',
                    'label' => 'Enabled',
                    'description' => 'Globally enable Offcanvas Toggle particles.',
                    'default' => true
                ],
                '_note' => [
                    'type' => 'separator.note',
                    'class' => 'alert alert-info',
                    'content' => 'Displays the Offcanvas Toggle Button.<br />This particle is designed to be used in the Menu only.<br /><br />Once you publish this particle, it hides the original toggle button for the viewport size specified under "Styles" tab -> "Breakpoints" -> "Mobile Menu".'
                ],
                'icon' => [
                    'type' => 'input.icon',
                    'label' => 'Icon',
                    'description' => 'Select the icon for the Offcanvas Toggle button.',
                    'default' => 'fa fa-bars'
                ]
            ]
        ]
    ]
];
