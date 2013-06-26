<?php

namespace SxBootstrap\Service;

use Assetic\Asset\AssetInterface;
use Assetic\Filter\FilterInterface;
use Assetic\Filter\LessFilter;
use Assetic\Filter\LessphpFilter;
use SxBootstrap\Exception;
use SxBootstrap\Options\ModuleOptions;

class BootstrapFilter implements FilterInterface
{

    /**
     * @var \Assetic\Filter\FilterInterface
     */
    protected $lessFilter;

    /**
     * @var ModuleOptions
     */
    protected $config;

    /**
     * Constructs the service right before
     *
     * @param ModuleOptions $config
     */
    public function __construct(ModuleOptions $config)
    {
        $this->config = $config;

        if ($this->config->getUseLessphp()) {
            $this->lessFilter = new LessphpFilter();
        } else {
            $filter           = $this->config->getFilter();
            $this->lessFilter = new LessFilter(
                $filter['node_bin'],
                $filter['node_paths']
            );
        }
    }

    /**
     * Sets the by-config generated imports on the asset.
     *
     * {@inheritDoc}
     */
    public function filterLoad(AssetInterface $asset)
    {
        $assetRoot      = $asset->getSourceRoot();
        $assetPath      = $asset->getSourcePath();
        $assetImportDir = dirname($assetRoot . '/' . $assetPath);
        $importDir      = $this->config->getBootstrapPath() . '/less';

        // Make sure we _always_ have the bootstrap import dir.
        if ($importDir !== $assetImportDir) {
            $this->lessFilter->addLoadPath($importDir);
        }

        $variables = array_merge(
            $this->extractVariables($importDir . '/variables.less'),
            $this->config->getVariables()
        );

        $variablesString = '';

        foreach ($variables as $key => $value) {
            $variablesString .= "@$key:$value;" . PHP_EOL;
        }

        if ('bootstrap.less' === $assetPath) {
            $imports = $this->filterImportFiles(array_unique(array_merge(
                $this->extractImports($importDir . '/bootstrap.less'),
                $this->extractImports($importDir . '/responsive.less')
            )));

            $assetContent = $variablesString . $imports;

            $asset->setContent($assetContent);
        } else {
            $asset->setContent($variablesString . $asset->getContent());
        }

        $this->lessFilter->filterLoad($asset);
    }

    /**
     * Extract the imports from the import file.
     *
     * @param $importsFile
     *
     * @return array The extracted imports
     */
    protected function extractImports($importsFile)
    {
        $str = file_get_contents($importsFile);

        preg_match_all('/@import "(?!variables)(?<imports>[\w-_\.]+)";/', $str, $matches);

        return array_map('trim', $matches['imports']);
    }

    /**
     * Extract the variables from the less file.
     *
     * @param string $variablesFile The path to the less file
     *
     * @return array The extracted variables
     */
    protected function extractVariables($variablesFile)
    {
        $str   = file_get_contents($variablesFile);
        $parts = explode(';', preg_replace('/(\/\/.*?\n|\s\n|\s{2,})/', '', $str));
        $vars  = array();

        foreach ($parts as $part) {
            $varMeta = explode(':', $part);
            if (empty($varMeta[0]) || empty($varMeta[1])) {
                continue;
            }
            $vars[substr(trim($varMeta[0]), 1)] = trim($varMeta[1]);
        }

        return $vars;
    }

    /**
     * Filter the import files needed.
     *
     * @param $imports
     *
     * @throws \SxBootstrap\Exception\RuntimeException
     * @return array
     */
    protected function filterImportFiles($imports)
    {
        $config = $this->config;

        $excludedComponents = $config->getExcludedComponents();
        $includedComponents = $config->getIncludedComponents();

        if (!empty($excludedComponents) && !empty($includedComponents)) {
            throw new Exception\RuntimeException(
                'You may not set both excluded and included components.'
            );
        }

        if (!empty($excludedComponents)) {
            $imports = $this->removeImportFiles($imports, $excludedComponents);
        } elseif (!empty($includedComponents)) {
            $imports = $this->addImportFiles($imports, $includedComponents);
        }

        array_walk($imports, function (&$val) {
            $val = "@import \"$val\";";
        });

        return implode(PHP_EOL, $imports);
    }

    /**
     * Remove import files from the import config.
     *
     * @param array $importFiles
     * @param array $config
     *
     * @return array
     */
    protected function removeImportFiles(array $importFiles, array $config)
    {
        foreach ($config as $item) {
            if (in_array($item, $importFiles)) {
                unset($importFiles[array_search($item, $importFiles)]);
            }
        }

        return $importFiles;
    }

    /**
     * Remove everything from the import config except for the values in $config
     *
     * @param array $importFiles
     * @param array $config
     *
     * @return array
     */
    protected function addImportFiles(array $importFiles, array $config)
    {
        foreach ($importFiles as $key => $if) {
            if (!in_array($if, $config)) {
                unset($importFiles[$key]);
            }
        }

        return $importFiles;
    }

    /**
     * {@inheritDoc}
     */
    public function filterDump(AssetInterface $asset)
    {
    }
}
