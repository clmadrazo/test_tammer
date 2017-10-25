<?php

namespace Solicitude\Controller;

use Test\Mvc\Controller\RestfulController;
use Zend\View\Model\JsonModel;

class GetController extends RestfulController {

    protected $_allowedMethod = "get";
    protected $em;
    protected $request;

    /**
     * @example
     *  [Request]
     *      GET /v1/rest/solicitude/[:id]
     *      Content-Type: application/json
     *
     * @return \Zend\View\Model\JsonModel
     */
    public function indexAction() {
        $this->em = $this->getEntityManager();
        $this->request = $this->getRequest();
        $data = $this->processBodyContent($this->request);
        $solicitude = $this->em->getRepository('Atendimento\Entity\Atendimento')->find($data['id']);
        if($solicitude){
            $this->getResponse()->setStatusCode(200);
            return $solicitude->getExpectedArray();
        }
        else {
            $this->getResponse()->setStatusCode(404);
            return new JsonModel(array("errors" => "Solicitude não encontrada"));
        }
        
            
    }

}
