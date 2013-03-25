<?php

$data          = json_decode(file_get_contents('vendor/composer/installed.json'), true);
$bootstrapPath = 'vendor/twitter/bootstrap';
foreach ($data as $installed) {
    if ('twitter/bootstrap' === $installed['name']) {
        $bootstrapPath = 'vendor/' . $installed['name'];
        if (!empty($installed['target-dir'])) {
            $bootstrapPath .= '/' . $installed['target-dir'];
        }
        break;
    }
}

return array(
    'controller_plugins' => array(
        'invokables' => array(
            'sxbFlashMessenger' => 'SxBootstrap\Controller\Plugin\FlashMessenger',
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'sxbCode'            => 'SxBootstrap\View\Helper\Bootstrap\Code',
            'sxbForm'            => 'SxBootstrap\View\Helper\Bootstrap\Form',
            'sxbFormElement'     => 'SxBootstrap\View\Helper\Bootstrap\FormElement',
            'sxbFormDescription' => 'SxBootstrap\View\Helper\Bootstrap\FormDescription',
            'sxbButtonGroup'     => 'SxBootstrap\View\Helper\Bootstrap\ButtonGroup',
            'sxbButtonToolbar'   => 'SxBootstrap\View\Helper\Bootstrap\ButtonToolbar',
            'sxbTabs'            => 'SxBootstrap\View\Helper\Bootstrap\Tabs',
            'sxbAlert'           => 'SxBootstrap\View\Helper\Bootstrap\Alert',
            'sxbBadge'           => 'SxBootstrap\View\Helper\Bootstrap\Badge',
            'sxbButton'          => 'SxBootstrap\View\Helper\Bootstrap\Button',
            'sxbLabel'           => 'SxBootstrap\View\Helper\Bootstrap\Label',
            'sxbWell'            => 'SxBootstrap\View\Helper\Bootstrap\Well',
            'sxbPagination'      => 'SxBootstrap\View\Helper\Bootstrap\Pagination',
            'sxbPager'           => 'SxBootstrap\View\Helper\Bootstrap\Pager',
            'sxbFormColorpicker' => 'SxBootstrap\View\Helper\Bootstrap\FormColorPicker',
            'sxBootstrap'        => 'SxBootstrap\View\Helper\Bootstrap\Bootstrap',
            'sxbFlashMessenger'  => 'SxBootstrap\View\Helper\Bootstrap\FlashMessenger',
        ),
    ),
    'asset_manager' => array(
        'resolvers' => array(
            'SxBootstrap\Service\BootstrapResolver' => 1200,
        ),
        'resolver_configs' => array(
            'map' => array(
                'css/colorpicker.css'                => __DIR__ . '/../public/css/colorpicker.css',
                'js/bootstrap-colorpicker.js'        => __DIR__ . '/../public/js/bootstrap-colorpicker.js',
                'img/alpha.png'                      => __DIR__ . '/../public/img/alpha.png',
                'img/hue.png'                        => __DIR__ . '/../public/img/hue.png',
                'img/saturation.png'                 => __DIR__ . '/../public/img/saturation.png',
                'img/glyphicons-halflings.png'       => $bootstrapPath . '/img/glyphicons-halflings.png',
                'img/glyphicons-halflings-white.png' => $bootstrapPath . '/img/glyphicons-halflings-white.png',
                'css/bootstrap.css'                  => $bootstrapPath . '/less/bootstrap.less',
            ),
            'paths' => array(
                $bootstrapPath,
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
    'twitter_bootstrap' => array(
        'bootstrap_path' => $bootstrapPath,
        'makefile' => $bootstrapPath . '/Makefile',
        'filter'   => array(
            'node_bin'   => '/usr/bin/node',
            'node_paths' => array('node_modules'),
        ),
        'use_lessphp'  => false,
        'variables'    => array(),
        'plugin_alias' => 'js/bootstrap.js',
    ),
);
