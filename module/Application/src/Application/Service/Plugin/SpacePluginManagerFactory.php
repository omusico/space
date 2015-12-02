<?php

namespace Application\Service\Plugin;

use Zend\Mvc\Service\AbstractPluginManagerFactory;

class SpacePluginManagerFactory extends AbstractPluginManagerFactory
{
    const PLUGIN_MANAGER_CLASS = 'Application\Service\Plugin\SpacePluginManager';
}