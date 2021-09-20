<?php

declare(strict_types=1);

namespace User;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'signup' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/signup',
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action' => 'create'
                    ],
                ],
            ],
            'login' => [
                'type' => Segment::class, # change route type from Literal to Segment
                'options' => [
                    'route' => '/login[/:returnUrl]',
                    'constraints' => [
                        'returnUrl' => '[a-zA-Z][a-zA-Z0-9_-]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\LoginController::class,
                        'action' => 'index'
                    ],
                ],
            ],
            'profile' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/profile[/:id[/:username]]',
                    'constraints' => [
                        'id' => '[0-9]+',
                        'username' => '[a-zA-Z][a-zA-Z0-9_-]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\ProfileController::class,
                        'action' => 'index'
                    ],
                ],
            ],
            'logout' => [
                'type' => Segment::class, # change route type from Literal to Segment
                'options' => [
                    'route' => '/logout',
                    'defaults' => [
                        'controller' => Controller\LogoutController::class,
                        'action' => 'index'
                    ],
                ],
            ],
            'error' => [
                'type' => Segment::class, # change route type from Literal to Segment
                'options' => [
                    'route' => '/error',
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action' => 'error'
                    ],
                ],
            ],

        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\UserController::class => Controller\Factory\UserControllerFactory::class,
            Controller\LoginController::class => Controller\Factory\LoginControllerFactory::class,
            Controller\LogoutController::class => InvokableFactory::class,
            Controller\ProfileController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [

            /** auth template map */
            'user/create'   => __DIR__ . '/../view/user/user/create.phtml',
            'login/index'   => __DIR__ . '/../view/user/user/login.phtml',
            'profile/index' => __DIR__ . '/../view/user/profile/index.phtml',
        ],
        'template_path_stack' => [
            'user' => __DIR__ . '/../view'
        ]
    ]
];
