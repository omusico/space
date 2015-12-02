<?php
namespace Application\Controller;

use Application\Service\Plugin\SpacePluginManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Model\ViewModel;

class SpaceController extends AbstractActionController
{
    public function indexAction()
    {
        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $this->getServiceLocator();
        /** @var SpacePluginManager $spaceManager */
        $spaceManager = $serviceLocator->get('SpacePluginManager');
        $space = $spaceManager->get('Product');

        return new ViewModel(array(
            'name' => $space->getName()
        ));
    }
}