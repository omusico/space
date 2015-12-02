<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Console' => 'Application\Controller\ConsoleController',
            'Application\Controller\Space' => 'Application\Controller\SpaceController',
            'Application\Controller\SpaceRestful' => 'Application\Controller\SpaceRestfulController',
            'Application\Controller\UserRestful' => 'Application\Controller\UserRestfulController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'space' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/spaces[/:action]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Space',
                        'action' => 'index',
                    ),
                ),
            ),
            'user-api' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/api/users[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\UserRestful',
                    ),
                )
            ),
        ),
    ),

    'service_manager' => array(
        'factories' => array(
            'SpacePluginManager' => 'Application\Service\Plugin\SpacePluginManagerFactory',
        ),
    ),
    'spaces' => array(
        'invokables' => array(
            'Product' => 'Application\Space\ProductSpace',
        ),
    ),

//    'service_listener_options' => array(
//        array(
//            'service_manager' => 'SpacePluginManager',
//            'config_key' => 'spaces',
//            'interface' => 'Application\Service\Plugin\SpacePluginProviderInterface',
//            'method' => 'getSpaceConfig',
//        ),
//    ),

    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
        'template_map' => include __DIR__ . '/../template_map.php',
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

    'console' => array(
        'router' => array(
            'routes' => array(
                'space' => array(
                    'options' => array(
                        'route' => 'space [--verbose|-v] <action>',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Console',
                            'action' => 'index'
                        ),
                    ),
                ),
            )
        )
    ),
);
