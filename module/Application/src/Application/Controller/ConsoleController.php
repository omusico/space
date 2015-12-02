<?php

namespace Application\Controller;

use Application\Generator\ModuleGenerator;
use Symfony\Component\Finder\Finder;
use Zend\Console\Request as ConsoleRequest;
use Zend\Filter\Word\CamelCaseToDash;
use Zend\Mvc\Controller\AbstractActionController;
use ZFTool\Model\Skeleton;

class ConsoleController extends AbstractActionController
{
    /**
     * <Description, starting with capital letter>
     *
     * @return void
     */
    public function createAction()
    {
        $request = $this->getRequest();

        // Make sure that we are running in a console and the user has not tricked our
        // application into running this action from a public web server.
        if (!$request instanceof ConsoleRequest) {
            throw new \RuntimeException('You can only use this action from a console!');
        }
        $verbose = $request->getParam('verbose');


        $moduleNamespaces = $this->getModuleNamespaces();

        $rootPath = realpath('.');
        $configRootPath = $rootPath . '/config';
        $console = $this->getServiceLocator()->get('console');
        $filter = new CamelCaseToDash();

        $finder = new Finder();

        foreach ($moduleNamespaces as $moduleNamespace => $modules) {
            foreach ($modules as $moduleName) {
                $moduleRootPath = $rootPath . '/module/' . $moduleNamespace . '/' . $moduleName;
                $dashedModuleName = strtolower($filter->filter($moduleNamespace . $moduleName));

                $viewDirectory = strtolower($filter->filter($moduleName));

                $moduleName = ucfirst($moduleName);
                mkdir($moduleRootPath . "/config", 0777, true);
                mkdir($moduleRootPath . "/src/" . $moduleName . "/Controller", 0777, true);
                mkdir($moduleRootPath . "/view/" . $viewDirectory, 0777, true);

                file_put_contents($moduleRootPath . "/Module.php", Skeleton::getModule($moduleName));


                $moduleConfig = array(
                    'router' => array(
                        'routes' => array(
                            $dashedModuleName => array(),
                            $dashedModuleName . '-api' => array(),
                        ),
                    ),
                );
                file_put_contents($moduleRootPath . "/config/module.config.php", '<?php return ' . var_export($moduleConfig, true) . ';');


                // Add the module in application.config.php
                $application = require $configRootPath . "/application.config.php";
                if (!in_array($moduleName, $application['modules'])) {
                    $application['modules'][] = $moduleName;
//                    copy($configRootPath . "/application.config.php", $configRootPath . "/application.config.old");

                    $content = '<?php return ' . Skeleton::exportConfig($application) . ";\n";
//                    file_put_contents($configRootPath. "/application.config.php", $content);
                }
                if ($rootPath === '.') {
                    $console->writeLine("The module $moduleName has been created");
                } else {
                    $console->writeLine("The module $moduleName has been created in $rootPath");
                }
            }
        }


    }

    /**
     * <Description, starting with capital letter>
     *
     * @return void
     */
    public function cloneAction()
    {
        $rootPath = $this->getRootPath();
        $configRootPath = $rootPath . '/config';
        $applicationConfig = require $configRootPath . "/application.config.php";
        $applicationConfig['modules'] = array(
            'Application'
        );

        $generator = new ModuleGenerator($this->getRootPath());
        $generator->setSkeletonDirectory($this->getRootPath() . '/data/skeleton');

        $moduleNamespaces = $this->getModuleNamespaces();
        foreach ($moduleNamespaces as $moduleNamespace => $modules) {
            foreach ($modules as $moduleName) {
                $fullyQualifiedModuleName = array($moduleNamespace, $moduleName);
                $generator->generate($fullyQualifiedModuleName);
                $applicationConfig['modules'][] = implode('', $fullyQualifiedModuleName);
            }
        }

        $content = '<?php return ' . Skeleton::exportConfig($applicationConfig) . ";\n";
        file_put_contents($configRootPath . "/application.config.php", $content);
    }

    protected function getRootPath()
    {
        $rootPath = realpath('.');

        return $rootPath;
    }

    /**
     * <Description, starting with capital letter>
     *
     *
     * @return array
     */
    public function getModuleNamespaces()
    {
        $moduleNamespaces = array(
            'Shop' => array(
                'Dashboard',
                'Order',
                'Customer',
                'Product',
                'Collection',
                'GiftCard',
                'Report',
                'Report'
            ),
            'Website' => array(
                'Blog',
                'Sites',
                'Navigation',
                'Theme'
            ),
            'Config' => array(
                'Apps',
                'Setting'
            )
        );
        return $moduleNamespaces;
    }

    protected function getSkeletonPath()
    {
        $skeletonPath = $this->getRootPath() . '/module/Skeleton/';

        return $skeletonPath;
    }
}
