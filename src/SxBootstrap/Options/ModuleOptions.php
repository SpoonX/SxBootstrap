<?php

namespace SxBootstrap\Options;

use Zend\Stdlib\AbstractOptions;

/**
 * Class ModuleOptions
 *
 * @package SxBootstrap\Options
 * @link    https://github.com/SpoonX/SxBootstrap/wiki/Configuration-options
 */
class ModuleOptions extends AbstractOptions
{

    /**
     * Turn off strict options mode
     *
     * @var boolean
     */
    protected $__strictMode__ = false;

    /**
     * @var string
     */
    protected $bootstrapPath = 'vendor/twbs/bootstrap';

    /**
     * @var string|null
     */
    protected $makeFile;

    /**
     * @var string
     */
    protected $nodeBin = '/usr/bin/node';

    /**
     * @var array
     */
    protected $nodePaths = array('node_modules');

    /**
     * @var boolean
     */
    protected $useLessphp = false;

    /**
     * @var array
     */
    protected $variables = array();

    /**
     * @var string
     */
    protected $pluginAlias = 'js/bootstrap.js';

    /**
     * @var array
     */
    protected $loadPaths = array();

    /**
     * @var array
     */
    protected $excludedPlugins = array();

    /**
     * @var array
     */
    protected $includedPlugins = array();

    /**
     * @var array
     */
    protected $excludedComponents = array();

    /**
     * @var array
     */
    protected $includedComponents = array();

    /**
     * @var array
     */
    protected $customComponents = array();

    /**
     * @var boolean
     */
    protected $useFontAwesome = false;

    /**
     * @var string
     */
    protected $fontAwesomePath = 'vendor/fortawesome/font-awesome';

    /**
     * Path to the nodejs binary
     *
     * @param string $nodeBin
     *
     * @link https://github.com/SpoonX/SxBootstrap/wiki/Configuration-options#node_bin
     */
    public function setNodeBin($nodeBin)
    {
        $this->nodeBin = $nodeBin;
    }

    /**
     * @return string
     */
    public function getNodeBin()
    {
        return $this->nodeBin;
    }

    /**
     * An array of paths to look in for node_modules.
     *
     * @param array $nodePaths
     *
     * @link https://github.com/SpoonX/SxBootstrap/wiki/Configuration-options#node_paths
     */
    public function setNodePaths($nodePaths)
    {
        $this->nodePaths = $nodePaths;
    }

    /**
     * @return array
     */
    public function getNodePaths()
    {
        return $this->nodePaths;
    }

    /**
     * Exclude components (blacklist).
     * This means that all components get included by default, except for the ones defined within this array.
     * FontAwesome is a realistic reason for you to want to use this and exclude the sprites.
     *
     * @param array $excludedComponents
     *
     * @link https://github.com/SpoonX/SxBootstrap/wiki/Configuration-options#excluded_components
     */
    public function setExcludedComponents($excludedComponents)
    {
        $this->excludedComponents = $excludedComponents;
    }

    /**
     * @return array
     */
    public function getExcludedComponents()
    {
        return $this->excludedComponents;
    }

    /**
     * This configuration option allows you to include (whitelist) components by name.
     * This means that it will by default, not include any other component besides the ones you've defined.
     * If it's not working, you might have forgotten to include a specific file.
     * (variables.less does get included by default, but mixins doesn't.)
     *
     * @param array $includedComponents
     *
     * @link https://github.com/SpoonX/SxBootstrap/wiki/Configuration-options#included_components
     */
    public function setIncludedComponents($includedComponents)
    {
        $this->includedComponents = $includedComponents;
    }

    /**
     * @return array
     */
    public function getIncludedComponents()
    {
        return $this->includedComponents;
    }

    /**
     * @param string $component
     *
     * @return $this
     */
    public function addIncludedComponent($component)
    {
        $this->includedComponents[] = (string) $component;

        return $this;
    }

    /**
     * This option allows you to exclude (blacklist) jquery plugins as packaged with twitter bootstrap.
     * Normally, you'd have to use the format bootstrap-pluginname.js, which I think is against the DRY principle.
     * For that reason, you only have to supply the name of the the plugin.
     *
     * @param array $excludedPlugins
     *
     * @link https://github.com/SpoonX/SxBootstrap/wiki/Configuration-options#excluded_plugins
     */
    public function setExcludedPlugins(array $excludedPlugins)
    {
        $this->excludedPlugins = $excludedPlugins;
    }

    /**
     * @return array
     */
    public function getExcludedPlugins()
    {
        return $this->excludedPlugins;
    }

    /**
     * This option allows you to include (whitelist) jquery plugins as packaged with twitter bootstrap.
     * Normally, you'd have to use the format bootstrap-pluginname.js, which I think is against the DRY principle.
     * For that reason, you only have to supply the name of the the plugin.
     *
     * @param array $includedPlugins
     *
     * @link https://github.com/SpoonX/SxBootstrap/wiki/Configuration-options#included_plugins
     */
    public function setIncludedPlugins(array $includedPlugins)
    {
        $this->includedPlugins = $includedPlugins;
    }

    /**
     * @return array
     */
    public function getIncludedPlugins()
    {
        return $this->includedPlugins;
    }

    /**
     * Where the bootstrap checkout files reside.
     * When using composer, the default will do just fine.
     *
     * @param string $bootstrapPath
     */
    public function setBootstrapPath($bootstrapPath)
    {
        $this->bootstrapPath = $bootstrapPath;
    }

    /**
     * @return string
     */
    public function getBootstrapPath()
    {
        return $this->bootstrapPath;
    }

    /**
     * Where the makefile is located. When "null", will use $bootstrapPath/makefile (usually fine).
     *
     * @param string $makeFile
     */
    public function setMakeFile($makeFile)
    {
        $this->makeFile = (string) $makeFile;
    }

    /**
     * @return string
     */
    public function getMakeFile()
    {
        if (empty($this->makeFile)) {
            return $this->getBootstrapPath() . '/Makefile';
        }

        return $this->makeFile;
    }

    /**
     * The alias to use for the url (to resolve to the bootstrap javascript file.)
     *
     * @param string $pluginAlias
     */
    public function setPluginAlias($pluginAlias)
    {
        $this->pluginAlias = (string) $pluginAlias;
    }

    /**
     * @return string
     */
    public function getPluginAlias()
    {
        return $this->pluginAlias;
    }

    /**
     * This option expects an array of load paths.
     * These paths will be added for every file that has the bootstrap filter applied to it,
     * allowing you to include less files from these locations, too.
     * By default the only two loadPaths are those of the asset being loaded, and twitter bootstrap.
     *
     * @param array $loadPaths
     *
     * @link https://github.com/SpoonX/SxBootstrap/wiki/Configuration-options#load_paths
     */
    public function setLoadPaths($loadPaths)
    {
        $this->loadPaths = (array) $loadPaths;
    }

    /**
     * @return array
     */
    public function getLoadPaths()
    {
        return $this->loadPaths;
    }

    /**
     * Whether or not to use lessPHP
     *
     * @param boolean $useLessphp
     */
    public function setUseLessphp($useLessphp)
    {
        $this->useLessphp = (bool) $useLessphp;
    }

    /**
     * @return boolean
     */
    public function getUseLessphp()
    {
        return $this->useLessphp;
    }

    /**
     * An array of variables used by the less renderer.
     *
     * @param array $variables
     *
     * @link https://github.com/SpoonX/SxBootstrap/wiki/Configuration-options#variables
     */
    public function setVariables(array $variables)
    {
        $this->variables = $variables;
    }

    /**
     * @return array
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * This option allows you to enable Font Awesome.
     * When enabled, all you have to do is add the Font Awesome dependency to your composer.json.
     *
     * @param boolean $useFontAwesome
     *
     * @link https://github.com/SpoonX/SxBootstrap/wiki/Configuration-options#use_font_awesome
     */
    public function setUseFontAwesome($useFontAwesome)
    {
        $this->useFontAwesome = (bool) $useFontAwesome;
    }

    /**
     * @return boolean
     */
    public function getUseFontAwesome()
    {
        return $this->useFontAwesome;
    }

    /**
     * @param string $fontAwesomePath
     */
    public function setFontAwesomePath($fontAwesomePath)
    {
        $this->fontAwesomePath = (string) $fontAwesomePath;
    }

    /**
     * The Custom components option allows you to specify an array of files,
     * that should be added to the bootstrap.css build when using the bootstrap asset helper.
     * This is especially useful when writing plugins for twitter bootstrap.
     *
     * @param array $customComponents
     *
     * @link https://github.com/SpoonX/SxBootstrap/wiki/Configuration-options#custom_components
     */
    public function setCustomComponents(array $customComponents)
    {
        $this->customComponents = $customComponents;
    }

    /**
     * @return array
     */
    public function getCustomComponents()
    {
        return $this->customComponents;
    }

    /**
     * @return string
     */
    public function getFontAwesomePath()
    {
        return $this->fontAwesomePath;
    }

}
