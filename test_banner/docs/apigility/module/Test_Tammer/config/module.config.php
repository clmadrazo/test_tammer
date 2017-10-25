<?php
return [
    'service_manager' => [
        'factories' => [
            \Test_Tammer\V1\Rest\Solicitude\SolicitudeResource::class => \Test_Tammer\V1\Rest\Solicitude\SolicitudeResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'test_tammer.rest.solicitude' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/solicitude[/:solicitude_id]',
                    'defaults' => [
                        'controller' => 'Test_Tammer\\V1\\Rest\\Solicitude\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'test_tammer.rest.solicitude',
        ],
    ],
    'zf-rest' => [
        'Test_Tammer\\V1\\Rest\\Solicitude\\Controller' => [
            'listener' => \Test_Tammer\V1\Rest\Solicitude\SolicitudeResource::class,
            'route_name' => 'test_tammer.rest.solicitude',
            'route_identifier_name' => 'solicitude_id',
            'collection_name' => 'solicitude',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Test_Tammer\V1\Rest\Solicitude\SolicitudeEntity::class,
            'collection_class' => \Test_Tammer\V1\Rest\Solicitude\SolicitudeCollection::class,
            'service_name' => 'Solicitude',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'Test_Tammer\\V1\\Rest\\Solicitude\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Test_Tammer\\V1\\Rest\\Solicitude\\Controller' => [
                0 => 'application/vnd.test_tammer.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Test_Tammer\\V1\\Rest\\Solicitude\\Controller' => [
                0 => 'application/vnd.test_tammer.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \Test_Tammer\V1\Rest\Solicitude\SolicitudeEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'test_tammer.rest.solicitude',
                'route_identifier_name' => 'solicitude_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \Test_Tammer\V1\Rest\Solicitude\SolicitudeCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'test_tammer.rest.solicitude',
                'route_identifier_name' => 'solicitude_id',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-content-validation' => [
        'Test_Tammer\\V1\\Rest\\Solicitude\\Controller' => [
            'input_filter' => 'Test_Tammer\\V1\\Rest\\Solicitude\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Test_Tammer\\V1\\Rest\\Solicitude\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'nome',
                'description' => 'Nome do solicitante',
                'field_type' => 'string',
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\EmailAddress::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'email',
                'description' => 'E-mail do solicitante',
                'field_type' => 'string',
            ],
            2 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'telefone',
                'description' => 'Telefone do solicitante',
                'field_type' => 'string',
            ],
            3 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'data_nascimento',
                'description' => 'Data de nascimento do solicitante',
                'field_type' => \datetime::class,
            ],
            4 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'cpf',
                'description' => 'CPF do solicitante',
                'field_type' => 'string',
            ],
            5 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'cep',
                'description' => 'CEP onde mora o solicitante',
                'field_type' => 'string',
            ],
            6 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'marca_id',
                'description' => 'Identificador da marca do carro',
            ],
        ],
    ],
];
