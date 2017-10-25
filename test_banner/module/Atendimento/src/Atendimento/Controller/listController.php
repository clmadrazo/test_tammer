<?php

namespace Atendimento\Controller;

use Test\Mvc\Controller\RestfulController;
use Zend\View\Model\JsonModel;

class ListController extends RestfulController {

    protected $_allowedMethod = "get";
    protected $em;

    /**
     * @example
     *  [Request]
     *      GET /v1/rest/atendimento
     *      Content-Type: application/json
     *
     * @return \Zend\View\Model\JsonModel
     */
    public function indexAction() {
        $this->em = $this->getEntityManager();
        return $this->getListAtendimento();
    }

    private function getListAtendimento() {
        $query = "SELECT * FROM atendimentos ORDER BY id DESC LIMIT 4";
        $res = $this->getEntityManager()->getConnection()->query($query);
        $result = $res->fetchAll();

        foreach ($result as $atendimentoId) {
            $atendimento = $this->em->getRepository('Atendimento\Entity\Atendimento')->find($atendimentoId['id']);
            $resultArray[] = $atendimento->getExpectedArray();
        }

        return new JsonModel(array("result" => $resultArray));
    }

}
