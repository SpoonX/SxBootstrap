<?php
namespace SxBootstrap\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\FlashMessenger as PluginFlashMessenger;

class FlashMessenger extends PluginFlashMessenger
{
    const NAMESPACE_WARNING = 'warning';

    /**
     * Whether "warning" namespace has messages
     * @return bool
     */
    public function hasWarningMessages()
    {
        $namespace = $this->getNamespace();
        $this->setNamespace(self::NAMESPACE_WARNING);
        $hasMessages = $this->hasMessages();
        $this->setNamespace($namespace);

        return $hasMessages;
    }

    /**
     * Add a message with "warning" type
     *
     * @param  string $message
     * @return FlashMessenger
     */
    public function addWarningMessage($message)
    {
        $namespace = $this->getNamespace();
        $this->setNamespace(self::NAMESPACE_WARNING);
        $this->addMessage($message);
        $this->setNamespace($namespace);

        return $this;
    }

    /**
     * Get messages from "warning" namespace
     *
     * @return array
     */
    public function getWarningMessages()
    {
        $namespace = $this->getNamespace();
        $this->setNamespace(self::NAMESPACE_WARNING);
        $messages = $this->getMessages();
        $this->setNamespace($namespace);

        return $messages;
    }
}