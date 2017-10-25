<?php
namespace Solicitude;

return array(
    'controllers' => array(
        'invokables' => array(
            'Solicitude\Controller\Add'            => 'Solicitude\Controller\AddController',
            'Solicitude\Controller\Get'            => 'Solicitude\Controller\GetController'
        ),
    ),
    'router' => array(
        'addSolicitude' => array(
            'type'    => 'segment',
            'options' => array(
                'route'    => '/v1/rest/solicitude[/]',
                'defaults' => array(
                    'controller' => 'Solicitude\Controller\Add',
                    'action' => 'add'
                ),
            ),
        ),
        'getSolicitude' => array(
            'type'    => 'segment',
            'options' => array(
                'route'    => '/v1/rest/solicitude/[:id][/]',
                'defaults' => array(
                    'controller' => 'Solicitude\Controller\Get',
                    'action' => 'index'
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