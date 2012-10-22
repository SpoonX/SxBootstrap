<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'tabs'            => 'SxBootstrap\View\Helper\Bootstrap\Tabs',
            'alert'           => 'SxBootstrap\View\Helper\Bootstrap\Alert',
            'badge'           => 'SxBootstrap\View\Helper\Bootstrap\Badge',
            'label'           => 'SxBootstrap\View\Helper\Bootstrap\Label',
            'formColorpicker' => 'SxBootstrap\View\Helper\Bootstrap\FormColorPicker',
            'bootstrap'       => 'SxBootstrap\View\Helper\Bootstrap\Bootstrap',
        ),
    ),
    'asset_manager'   => array(
        'resolvers' => array(
            'SxBootstrap\Service\BootstrapResolver' => 1200,
        ),
        'resolver_configs' => array(
            'map' => array(
                'css/colorpicker.css'                   => __DIR__ . '/../public/css/colorpicker.css',
                'js/bootstrap-colorpicker.js'           => __DIR__ . '/../public/js/bootstrap-colorpicker.js',
                'img/alpha.png'                         => __DIR__ . '/../public/img/alpha.png',
                'img/hue.png'                           => __DIR__ . '/../public/img/hue.png',
                'img/saturation.png'                    => __DIR__ . '/../public/img/saturation.png',
                'img/glyphicons-halflings.png'          => 'vendor/twitter/bootstrap/img/glyphicons-halflings.png',
                'img/glyphicons-halflings-white.png'    => 'vendor/twitter/bootstrap/img/glyphicons-halflings-white.png',
                'css/bootstrap.css'                     => 'vendor/twitter/bootstrap/less/bootstrap.less',
            ),
            'paths' => array(
                'vendor/twitter/bootstrap',
            ),
        ),
        'filters' => array(
            'css/bootstrap.css' => array(
                array(
                    'service' => 'SxBootstrap\Service\BootstrapFilter',
                ),
            ),
        ),
    ),
    'service_manager' => array (
        'factories' => array (
            'SxBootstrap\Service\BootstrapFilter' => function($serviceManager) {
                $config             = $serviceManager->get('Config');
                $bootstrapConfig    = $config['twitter_bootstrap'];
                $BootstrapFilter    = new SxBootstrap\Service\BootstrapFilter($bootstrapConfig);

                return $BootstrapFilter;
            },
            'SxBootstrap\Service\BootstrapResolver' => function($serviceManager) {
                $config             = $serviceManager->get('Config');
                $bootstrapConfig    = $config['twitter_bootstrap'];
                $assetFilterManager = new SxBootstrap\Service\BootstrapResolver($bootstrapConfig);

                return $assetFilterManager;
            },
        ),
    ),
    'twitter_bootstrap' => array(
        'makefile'      => 'vendor/twitter/bootstrap/Makefile',
        'filter'        => array(
            'node_bin'      => '/usr/bin/node',
            'node_paths'    => array(),
        ),
        'variables'     => array(),
        'plugin_alias'  => 'js/bootstrap.js',
    ),
);
