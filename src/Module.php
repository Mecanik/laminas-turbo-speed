<?php
/**
 * Laminas Turbo Speed Module
 * 
 * @link https://github.com/Mecanik/LaminasTurboSpeed
 * @copyright Copyright (c) 2020 Norbert Boros ( a.k.a Mecanik )
 * @license https://github.com/Mecanik/LaminasTurboSpeed/blob/master/LICENSE.md
 */

namespace Mecanik\LaminasTurboSpeed;
use Laminas\Mvc\MvcEvent;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    // onBootstrap() is called once all modules are initialized.
    public function onBootstrap(MvcEvent $event)
    {
        $eventManager = $event->getApplication()->getEventManager();

        $serviceManager = $event->getApplication()->getServiceManager();

        $config = $serviceManager->get('config');

        if(!isset($config['turbolaminas'])) {
            throw new Exception\RuntimeException('Unable to load configuration; did you forget to create turbolaminas.global.php ?');
        }

        $listener = new \Mecanik\LaminasTurboSpeed\Listener\LaminasTurboSpeedListener($config['turbolaminas']);

        $listener->attach($eventManager);
    }
}
