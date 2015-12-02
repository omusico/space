<?php

namespace Application\Space;

use Application\Service\Plugin\SpacePluginInterface;

class ProductSpace implements SpacePluginInterface
{
    public function getName()
    {
        return 'product-space';
    }
}