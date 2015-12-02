<?php

namespace Application\Service\Plugin;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception;
use Zend\ServiceManager\Exception\RuntimeException;

/**
 * Class SpacePluginManager
 *
 * PHP Version 5
 *
 * @category  PHP
 * @package   Application\Service\Plugin
 * @author    Simplicity Trade GmbH <it@simplicity.ag>
 * @copyright 2014-2015 Simplicity Trade GmbH
 * @license   Proprietary http://www.simplicity.ag
 */
class SpacePluginManager extends AbstractPluginManager
{

    /**
     * Validate the plugin
     *
     * Checks that the filter loaded is either a valid callback or an instance
     * of FilterInterface.
     *
     * @param  mixed $plugin
     * @return void
     * @throws RuntimeException if invalid
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof SpacePluginInterface) {
            return;
        }

        throw new RuntimeException(sprintf(
            'Plugin of type %s is invalid; must implement %s\SpacePluginInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
            __NAMESPACE__
        ));
    }
}