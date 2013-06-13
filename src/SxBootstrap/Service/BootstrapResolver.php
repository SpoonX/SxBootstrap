<?php

namespace SxBootstrap\Service;

use Assetic\Asset\AssetCollection;
use Assetic\Asset\AssetInterface;
use AssetManager\Resolver\AggregateResolverAwareInterface;
use AssetManager\Resolver\ResolverInterface;
use AssetManager\Service\AssetFilterManagerAwareInterface;
use AssetManager\Service\AssetFilterManager;
use SxBootstrap\Exception;

class BootstrapResolver implements
    ResolverInterface,
    AggregateResolverAwareInterface,
    AssetFilterManagerAwareInterface
{
    /**
     * @var array Resolver configuration.
     */
    protected $config;

    /**
     * @var ResolverInterface
     */
    protected $aggregateResolver;

    /**
     * @var AssetFilterManager The filterManager service.
     */
    protected $filterManager;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function resolve($path)
    {
        if ($path !== $this->config['plugin_alias']) {
            return;
        }

        return $this->resolvePlugins();
    }

    /**
     * Resolve to the plugins for this module (expand).
     *
     * @return AssetCollection
     */
    protected function resolvePlugins()
    {
        $config      = $this->config;
        $pluginFiles = $this->getPluginNames($config['makefile']);

        if (!empty($config['excluded_plugins']) && !empty($config['included_plugins'])) {
            throw new Exception\RuntimeException(
                'You may not set both excluded and included plugins.'
            );
        }

        $pluginsAsset = new AssetCollection;
        $mimeType     = null;

        foreach ($pluginFiles as $plugin) {

            if (!empty($config['excluded_plugins'])
                && in_array($plugin, $config['excluded_plugins'])
            ) {
                continue;
            } elseif (!empty($config['included_plugins'])
                      && !in_array($plugin, $config['included_plugins'])
            ) {
                continue;
            }

            $res = $this->getAggregateResolver()->resolve('js/bootstrap-'.$plugin.'.js');

            if (null === $res) {
                throw new Exception\RuntimeException("Asset '$plugin' could not be found.");
            }

            if (!$res instanceof AssetInterface) {
                throw new Exception\RuntimeException(
                    "Asset '$asset' does not implement Assetic\\Asset\\AssetInterface."
                );
            }

            if (null !== $mimeType && $res->mimetype !== $mimeType) {
                throw new Exception\RuntimeException(sprintf(
                    'Asset "%s" from collection "%s" doesn\'t have the expected mime-type "%s".',
                    $plugin,
                    $config['plugin_alias'],
                    $mimeType
                ));
            }

            $mimeType = $res->mimetype;

            $this->getAssetFilterManager()->setFilters($plugin, $res);

            $pluginsAsset->add($res);
        }

        $pluginsAsset->mimetype = $mimeType;

        return $pluginsAsset;
    }

    /**
     * Get the plugin names from the makefile.
     *
     * @param string $makefile /path/to/Makefile
     *
     * @return array plugin names.
     */
    protected function getPluginNames($makefile)
    {
        $mkdata = file_get_contents($makefile);

        preg_match(
            '/bootstrap(\:|\/js\/\*\.js: js\/\*\.js)\s?\n(\n|.)*?((cat\s)(?P<files>.*?))\s>/i',
            $mkdata, $matches
        );

        return array_map(function($value) {
            return preg_replace('/(js\/bootstrap-([\w_-]+)\.js)/', '\2', $value);
        }, preg_split('/\s+/', $matches['files']));
    }

    /**
     * Set the aggregate resolver.
     *
     * @param ResolverInterface $aggregateResolver
     */
    public function setAggregateResolver(ResolverInterface $aggregateResolver)
    {
        $this->aggregateResolver = $aggregateResolver;
    }

    /**
     * Get the aggregate resolver.
     *
     * @return ResolverInterface
     */
    public function getAggregateResolver()
    {
        return $this->aggregateResolver;
    }

    /**
     * Set the AssetFilterManager.
     *
     * @param AssetFilterManager $filterManager
     */
    public function setAssetFilterManager(AssetFilterManager $filterManager)
    {
        $this->filterManager = $filterManager;
    }

    /**
     * Get the AssetFilterManager
     *
     * @return AssetFilterManager
     */
    public function getAssetFilterManager()
    {
        return $this->filterManager;
    }
}
