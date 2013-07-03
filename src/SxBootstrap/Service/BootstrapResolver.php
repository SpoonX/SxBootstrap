<?php

namespace SxBootstrap\Service;

use Assetic\Asset\AssetCollection;
use Assetic\Asset\AssetInterface;
use AssetManager\Resolver\AggregateResolverAwareInterface;
use AssetManager\Resolver\ResolverInterface;
use AssetManager\Service\AssetFilterManagerAwareInterface;
use AssetManager\Service\AssetFilterManager;
use SxBootstrap\Exception;
use SxBootstrap\Options\ModuleOptions;

class BootstrapResolver implements
    ResolverInterface,
    AggregateResolverAwareInterface,
    AssetFilterManagerAwareInterface
{

    /**
     * @var ModuleOptions Resolver configuration.
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

    public function __construct(ModuleOptions $config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function resolve($path)
    {
        if ($path !== $this->config->getPluginAlias()) {
            return null;
        }

        return $this->resolvePlugins();
    }

    /**
     * Resolve to the plugins for this module (expand).
     *
     * @throws \SxBootstrap\Exception\RuntimeException
     * @return \Assetic\Asset\AssetCollection
     */
    protected function resolvePlugins()
    {
        $config          = $this->config;
        $pluginFiles     = $this->getPluginNames($config->getMakeFile());
        $includedPlugins = $config->getIncludedPlugins();
        $excludedPlugins = $config->getExcludedPlugins();

        if (!empty($excludedPlugins) && !empty($includedPlugins)) {
            throw new Exception\RuntimeException(
                'You may not set both excluded and included plugins.'
            );
        }

        $pluginsAsset = new AssetCollection;
        $mimeType     = null;

        foreach ($pluginFiles as $plugin) {

            if (!empty($excludedPlugins)
                && in_array($plugin, $excludedPlugins)
            ) {
                continue;
            } elseif (!empty($includedPlugins)
                && !in_array($plugin, $includedPlugins)
            ) {
                continue;
            }

            $res = $this->getAggregateResolver()->resolve('js/bootstrap-' . $plugin . '.js');

            if (null === $res) {
                throw new Exception\RuntimeException("Asset '$plugin' could not be found.");
            }

            if (!$res instanceof AssetInterface) {
                throw new Exception\RuntimeException(
                    "Asset '$plugin' does not implement Assetic\\Asset\\AssetInterface."
                );
            }

            if (null !== $mimeType && $res->mimetype !== $mimeType) {
                throw new Exception\RuntimeException(sprintf(
                    'Asset "%s" from collection "%s" doesn\'t have the expected mime-type "%s".',
                    $plugin,
                    $config->getPluginAlias(),
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

        return array_map(function ($value) {
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
