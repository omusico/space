<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'ShopDashboard\Controller\Module' => 'ShopDashboard\Controller\ModuleController',
            'ShopDashboard\Controller\ModuleRestful' => 'ShopDashboard\Controller\ModuleRestfulController'
        ),
    ),
    'router' => array(
        'routes' => array(
            '%module%' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/%module%[/:action]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Module',
                        'action' => 'index',
                    ),
                ),
            ),
            '%module%-api' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/api/%module%[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\ModuleRestful',
                    ),
                )
            )
        )
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);