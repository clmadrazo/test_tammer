<?php
namespace Test_Tammer\V1\Rest\Solicitude;

class SolicitudeResourceFactory
{
    public function __invoke($services)
    {
        return new SolicitudeResource();
    }
}
