<?php
namespace Cotacao;

return array(
    'controllers' => array(
        'invokables' => array(
            'Cotacao\Controller\Calc'            => 'Cotacao\Controller\CalcController'
        ),
    ),
    'router' => array(
        'calcCotacao' => array(
            'type'    => 'segment',
            'options' => array(
                'route'    => '/v1/rest/cotacao[/]',
                'defaults' => array(
                    'controller' => 'Cotacao\Controller\Calc',
                    'action' => 'index'
                ),
            ),
        )
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