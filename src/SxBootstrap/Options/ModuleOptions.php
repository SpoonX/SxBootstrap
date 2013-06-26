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
    protected $bootstrapPath = 'vendor/twitter/bootstrap';

    /**
     * @var string|null
     */
    protected $makeFile;

    /**
     * @var array
     */
    protected $filter = array(
        'node_bin'   => '/usr/bin/node',
        'node_paths' => array('node_modules'),
    );

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
    protected $plugin_alias = 'js/bootstrap.js';

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
     * An array of filter options. Possible keys are:
     *  - node_bin      Path to the nodejs binary
     *  - node_paths    An array of paths to look in for node_modules.
     *
     * @param array $filter
     */
    public function setFilter(array $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @return array
     */
    public function getFilter()
    {
        return $this->filter;
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
        if (null === $this->makeFile) {
            return $this->getBootstrapPath() . '/makefile';
        }

        return $this->makeFile;
    }

    /**
     * The alias to use for the url (to resolve to the bootstrap javascript file.)
     *
     * @param string $plugin_alias
     */
    public function setPluginAlias($plugin_alias)
    {
        $this->plugin_alias = (string) $plugin_alias;
    }

    /**
     * @return string
     */
    public function getPluginAlias()
    {
        return $this->plugin_alias;
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
}
