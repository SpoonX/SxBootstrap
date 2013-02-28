<?php
/**
 * SxBootstrap
 *
 * @category SxBootstrap
 * @package SxBootstrap_View
 * @subpackage Helper
 *
 * @method \SxBootstrap\Controller\Plugin\FlashMessenger getPluginFlashMessenger()
 */
namespace SxBootstrap\View\Helper\Bootstrap;

use SxBootstrap\Controller\Plugin\FlashMessenger as PluginFlashMessenger;
use Zend\View\Helper\AbstractHelper;

class FlashMessenger extends AbstractHelper
{
    protected $classMessages = array(
        PluginFlashMessenger::NAMESPACE_INFO => 'alert alert-info',
        PluginFlashMessenger::NAMESPACE_DEFAULT => 'alert alert-info',
        PluginFlashMessenger::NAMESPACE_SUCCESS => 'alert alert-success',
        PluginFlashMessenger::NAMESPACE_WARNING => 'alert alert-warning',
        PluginFlashMessenger::NAMESPACE_ERROR => 'alert alert-error',
    );

    /**
     * @param null $namespace
     * @param bool $isBlock
     * @return string
     */
    public function __invoke($namespace = null, $isBlock = false)
    {
        if($namespace) {
            $messagesToPrint = $this->view->flashMessenger()->render($namespace);
            if (empty($messagesToPrint)) {
                return '';
            }
            $class = '';
            if (isset($this->classMessages[$namespace])) {
                $class = $this->classMessages[$namespace];
            }
            return $this->view->sxbAlert($messagesToPrint, $isBlock, $class);
        }

        $return = '';
        foreach ($this->classMessages as $namespace => $class) {
            $messagesToPrint = $this->view->flashMessenger()->render($namespace);
            if (!empty($messagesToPrint)) {
                if (isset($this->classMessages[$namespace])) {
                    $class = $this->classMessages[$namespace];
                }
                $return .= $this->view->sxbAlert($messagesToPrint, $isBlock, $class);
            }
        }
        return $return;
    }
}