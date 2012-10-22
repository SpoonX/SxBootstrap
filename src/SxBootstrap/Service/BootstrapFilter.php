<?php

namespace SxBootstrap\Service;

use Assetic\Asset\AssetInterface;
use Assetic\Filter\LessFilter;
use SxBootstrap\Exception;

class BootstrapFilter extends LessFilter
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * @var AssetInterface
     */
    protected $asset;

    /**
     * Constructs the service right before
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;

        parent::__construct(
            $this->config['filter']['node_bin'],
            $this->config['filter']['node_paths']
        );
    }

    /**
     * Sets the by-config generated imports on the asset.
     *
     * {@inheritDoc}
     */
    public function filterLoad(AssetInterface $asset)
    {
        $root      = $asset->getSourceRoot();
        $path      = $asset->getSourcePath();
        $importDir = dirname($root.'/'.$path);

        $variables = array_merge(
            $this->extractVariables($importDir.'/variables.less'),
            $this->config['variables']
        );

        $imports   = $this->filterImportFiles(
            array_unique(
                array_merge(
                    $this->extractImports($importDir.'/bootstrap.less'),
                    $this->extractImports($importDir.'/responsive.less')
                )
            )
        );

        $variablesString = '';

        foreach ($variables as $key => $value) {
            $variablesString .= "@$key:$value;".PHP_EOL;
        }

        $assetContent = $variablesString . $imports;
        $asset->setContent($assetContent);

        parent::filterLoad($asset);
    }

    /**
     * Extract the imports from the import file.
     *
     * @param   string  $variablesFile
     * @return  array   The extracted imports
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
     * @param   string  $variablesFile  The path to the less file
     * @return  array   The extracted variables
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
     * @return array
     * @throws Exception\RuntimeException
     */
    protected function filterImportFiles($imports)
    {
        $config = $this->config;

        if (!empty($config['excluded_components']) && !empty($config['included_components'])) {
            throw new Exception\RuntimeException(
                'You may not set both excluded and included components.'
            );
        }

        if (!empty($config['excluded_components'])) {
            $imports = $this->removeImportFiles($imports, $config['excluded_components']);
        } elseif(!empty($config['included_components'])) {
            $imports = $this->addImportFiles($imports, $config['included_components']);
        }

        array_walk($imports, function(&$val) {
            $val = "@import \"$val\";";
        });

        return implode(PHP_EOL, $imports);
    }

    /**
     * Remove import files from the import config.
     *
     * @param array $config
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
     * @param array $config
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
