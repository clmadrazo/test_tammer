<?php
namespace Atendimento;

return array(
    'controllers' => array(
        'invokables' => array(
            'Atendimento\Controller\Add'            => 'Atendimento\Controller\AddController',
            'Atendimento\Controller\List'            => 'Atendimento\Controller\ListController'
        ),
    ),
    'router' => array(
        'routes' => array(
            'addAtendimento' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/v1/rest/atendimento[/]',
                    'defaults' => array(
                        'controller' => 'Atendimento\Controller\Add',
                        'action' => 'add'
                    ),
                ),
            ),
            'listAtendimento' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/v1/rest/atendimento/list[/]',
                    'defaults' => array(
                        'controller' => 'Atendimento\Controller\List',
                        'action' => 'index'
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
);