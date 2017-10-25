<?php
namespace Test_Tammer\V1\Rest\Adicionar_Solicitude;

class Adicionar_SolicitudeResourceFactory
{
    public function __invoke($services)
    {
        return new Adicionar_SolicitudeResource();
    }
}
