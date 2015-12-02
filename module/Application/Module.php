<?php

namespace Application;

use Zend\Console\Adapter\AdapterInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;

class Module implements ConfigProviderInterface, AutoloaderProviderInterface, InitProviderInterface, ConsoleUsageProviderInterface
{
    public function init(ModuleManagerInterface $moduleManager)
    {
        $serviceManager = $moduleManager->getEvent()->getParam('ServiceManager');
        $serviceListener = $serviceManager->get('ServiceListener');
        $serviceListener->addServiceManager(
            'SpacePluginManager',
            'spaces',
            'Application\Service\Plugin\SpacePluginProviderInterface',
            'getSpaceConfig'
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }


    /**
     * Returns an array or a string containing usage information for this module's Console commands.
     * The method is called with active Zend\Console\Adapter\AdapterInterface that can be used to directly access
     * Console and send output.
     *
     * If the result is a string it will be shown directly in the console window.
     * If the result is an array, its contents will be formatted to console window width. The array must
     * have the following format:
     *
     *     return array(
     *                'Usage information line that should be shown as-is',
     *                'Another line of usage info',
     *
     *                '--parameter'        =>   'A short description of that parameter',
     *                '-another-parameter' =>   'A short description of another parameter',
     *                ...
     *            )
     *
     * @param AdapterInterface $console
     * @return array|string|null
     */
    public function getConsoleUsage(AdapterInterface $console)
    {
        return array(
            'space [--verbose|-v] <action>' => 'Get Process already happen',

            array('action', 'Action'),
            array('--verbose|-v', '(optional) turn on verbose mode'),

        );
    }
}
