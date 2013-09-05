<?php

$bootstrapPath = 'vendor/twbs/bootstrap';
$fontAwesomePath = 'vendor/fortawesome/font-awesome';

return array(
    'controller_plugins' => array(
        'invokables' => array(
            'sxbFlashMessenger' => 'SxBootstrap\Controller\Plugin\FlashMessenger',
        )
    ),
    'view_manager'       => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'service_manager'    => array(
        'factories' => array(
            'SxBootstrap\Options\ModuleOptions'     => 'SxBootstrap\Options\ModuleOptionsFactory',
            'SxBootstrap\Service\BootstrapFilter'   => 'SxBootstrap\Service\BootstrapFilterServiceFactory',
            'SxBootstrap\Service\BootstrapResolver' => 'SxBootstrap\Service\BootstrapResolverServiceFactory',
        ),
    ),
    'view_helpers'       => array(
        'invokables' => array(
            'sxbCode'              => 'SxBootstrap\View\Helper\Bootstrap\Code',
            'sxbForm'              => 'SxBootstrap\View\Helper\Bootstrap\Form\Form',
            'sxbButtonGroup'       => 'SxBootstrap\View\Helper\Bootstrap\ButtonGroup',
            'sxbButtonToolbar'     => 'SxBootstrap\View\Helper\Bootstrap\ButtonToolbar',
            'sxbTabs'              => 'SxBootstrap\View\Helper\Bootstrap\Tabs',
            'sxbAlert'             => 'SxBootstrap\View\Helper\Bootstrap\Alert',
            'sxbBadge'             => 'SxBootstrap\View\Helper\Bootstrap\Badge',
            'sxbButton'            => 'SxBootstrap\View\Helper\Bootstrap\Button',
            'sxbLabel'             => 'SxBootstrap\View\Helper\Bootstrap\Label',
            'sxbWell'              => 'SxBootstrap\View\Helper\Bootstrap\Well',
            'sxbPagination'        => 'SxBootstrap\View\Helper\Bootstrap\Pagination',
            'sxbPager'             => 'SxBootstrap\View\Helper\Bootstrap\Pager',
            'sxbFormColorpicker'   => 'SxBootstrap\View\Helper\Bootstrap\FormColorPicker',
            'sxBootstrap'          => 'SxBootstrap\View\Helper\Bootstrap\Bootstrap',
            'sxbFlashMessenger'    => 'SxBootstrap\View\Helper\Bootstrap\FlashMessenger',
            'sxbNavigationMenu'    => 'SxBootstrap\View\Helper\Bootstrap\NavigationMenu',
            'sxbModal'             => 'SxBootstrap\View\Helper\Bootstrap\Modal',
            'sxbTooltip'           => 'SxBootstrap\View\Helper\Bootstrap\Tooltip',
            'sxbFormElement'       => 'SxBootstrap\View\Helper\Bootstrap\Form\Element',
            'sxbFormRow'           => 'SxBootstrap\View\Helper\Bootstrap\Form\Row',
            'sxbFormDescription'   => 'SxBootstrap\View\Helper\Bootstrap\Form\Description',
            'sxbFormErrors'        => 'SxBootstrap\View\Helper\Bootstrap\Form\Errors',
            'sxbFormInput'         => 'SxBootstrap\View\Helper\Bootstrap\Form\Input',
            'sxbFormPassword'      => 'SxBootstrap\View\Helper\Bootstrap\Form\Password',
            'sxbFormSubmit'        => 'SxBootstrap\View\Helper\Bootstrap\Form\Submit',
            'sxbFormActions'       => 'SxBootstrap\View\Helper\Bootstrap\Form\Actions',
            'sxbFormButton'        => 'SxBootstrap\View\Helper\Bootstrap\Form\Button',
            'sxbFormColor'         => 'SxBootstrap\View\Helper\Bootstrap\Form\Color',
            'sxbFormControlGroup'  => 'SxBootstrap\View\Helper\Bootstrap\Form\ControlGroup',
            'sxbFormControlLabel'  => 'SxBootstrap\View\Helper\Bootstrap\Form\ControlLabel',
            'sxbFormControls'      => 'SxBootstrap\View\Helper\Bootstrap\Form\Controls',
            'sxbFormDate'          => 'SxBootstrap\View\Helper\Bootstrap\Form\Date',
            'sxbFormDateTimeLocal' => 'SxBootstrap\View\Helper\Bootstrap\Form\DateTimeLocal',
            'sxbFormDateTime'      => 'SxBootstrap\View\Helper\Bootstrap\Form\DateTime',
            'sxbFormEmail'         => 'SxBootstrap\View\Helper\Bootstrap\Form\Email',
            'sxbFormError'         => 'SxBootstrap\View\Helper\Bootstrap\Form\Error',
            'sxbFormFile'          => 'SxBootstrap\View\Helper\Bootstrap\Form\File',
            'sxbFormHidden'        => 'SxBootstrap\View\Helper\Bootstrap\Form\Hidden',
            'sxbFormImage'         => 'SxBootstrap\View\Helper\Bootstrap\Form\Image',
            'sxbFormMonth'         => 'SxBootstrap\View\Helper\Bootstrap\Form\Month',
            'sxbFormNumber'        => 'SxBootstrap\View\Helper\Bootstrap\Form\Number',
            'sxbFormRange'         => 'SxBootstrap\View\Helper\Bootstrap\Form\Range',
            'sxbFormReset'         => 'SxBootstrap\View\Helper\Bootstrap\Form\Reset',
            'sxbFormSearch'        => 'SxBootstrap\View\Helper\Bootstrap\Form\Search',
            'sxbFormTel'           => 'SxBootstrap\View\Helper\Bootstrap\Form\Tel',
            'sxbFormTime'          => 'SxBootstrap\View\Helper\Bootstrap\Form\Time',
            'sxbFormUrl'           => 'SxBootstrap\View\Helper\Bootstrap\Form\Url',
            'sxbFormWeek'          => 'SxBootstrap\View\Helper\Bootstrap\Form\Week',
        ),
    ),
    'asset_manager'      => array(
        'resolvers'        => array(
            'SxBootstrap\Service\BootstrapResolver' => 1200,
        ),
        'resolver_configs' => array(
            'map'   => array(
                'css/colorpicker.css'                => __DIR__ . '/../public/css/colorpicker.css',
                'js/bootstrap-colorpicker.js'        => __DIR__ . '/../public/js/bootstrap-colorpicker.js',
                'img/alpha.png'                      => __DIR__ . '/../public/img/alpha.png',
                'img/hue.png'                        => __DIR__ . '/../public/img/hue.png',
                'img/saturation.png'                 => __DIR__ . '/../public/img/saturation.png',
                'img/glyphicons-halflings.png'       => $bootstrapPath . '/img/glyphicons-halflings.png',
                'img/glyphicons-halflings-white.png' => $bootstrapPath . '/img/glyphicons-halflings-white.png',
                'css/bootstrap.css'                  => $bootstrapPath . '/less/bootstrap.less',
                'font/fontawesome-webfont.woff'      => $fontAwesomePath . '/font/fontawesome-webfont.woff',
                'font/fontawesome-webfont.eot'       => $fontAwesomePath . '/font/fontawesome-webfont.eot',
                'font/fontawesome-webfont.svg'       => $fontAwesomePath . '/font/fontawesome-webfont.svg',
                'font/fontawesome-webfont.ttf'       => $fontAwesomePath . '/font/fontawesome-webfont.ttf',
                'font/fontawesome.otf'               => $fontAwesomePath . '/font/fontawesome.otf',
            ),
            'paths' => array(
                $bootstrapPath,
            ),
        ),
        'filters'          => array(
            'css/bootstrap.css' => array(
                array(
                    'service' => 'SxBootstrap\Service\BootstrapFilter',
                ),
            ),
        ),
    ),
);
