<?php

namespace Application\Service\Plugin;

/**
 * Interface SpacePluginInterface
 *
 * PHP Version 5
 *
 * @category  PHP
 * @package   Application\Service\Plugin
 * @author    Simplicity Trade GmbH <it@simplicity.ag>
 * @copyright 2014-2015 Simplicity Trade GmbH
 * @license   Proprietary http://www.simplicity.ag
 */
interface SpacePluginInterface
{
    /**
     * Available plugin modes
     *
     * @return array
     */
    public function getName();
}