<?php

namespace Cotacao\Controller;

use Test\Mvc\Controller\RestfulController;
use Zend\View\Model\JsonModel;

class CalcController extends RestfulController {

    protected $_allowedMethod = "post";
    protected $em;
    protected $request;
    protected $requestData;

    /**
     * @example
     *  [Request]
     *      POST /v1/rest/cotacao
     *      Content-Type: application/json
     *
     * @return \Zend\View\Model\JsonModel
     */
    public function indexAction() {
        $this->request = $this->getRequest();
        $data = $this->processBodyContent($this->request);
        $this->em = $this->getEntityManager();
        $query = "SELECT * FROM descontos u WHERE u.marca_id = " . $data['marca_id'];
        $marca = $this->em->getRepository('Cotacao\Entity\Marca')->find($data['marca_id']);
        $res = $this->em->getConnection()->query($query);
        $result = $res->fetchAll();
        $cotacao = array();        
        $cotacao['marca'] = $marca;
        foreach ($result as $cotacao) {
            $seguradora = $this->em->getRepository('Cotacao\Entity\Seguradora')->find($cotacao['seguradora_id']);
            $valor = 1500 + $this->em->getRepository('Cotacao\Entity\Desconto')->find($cotacao['desconto']);
            $resultArray[] = array(
                'seguradora' => $seguradora,
                'valor' => $valor
                                );;
        }
        $cotacao['seguradora_valor'] = $resultArray[];
        return new JsonModel(array("result" => $cotacao));
    }

}
