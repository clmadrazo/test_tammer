<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Solicitude\Controller;

use Test\Mvc\Controller\RestfulController;
use Zend\View\Model\JsonModel;

class addController extends RestfulController
{
    protected $em;
    protected $_allowedMethod = 'PUT';
    protected $request;
    protected $requestData;
    
    public function addAction()
    {
        $this->request = $this->getRequest();
        $data = $this->processBodyContent($this->request);
        $this->em = $this->getEntityManager();
        $solicitude = $this->_fillSolicitude($data);
        if ($solicitude->isValid()) {
            $this->em->persist($solicitude);
            $this->em->flush();
            $this->getResponse()->setStatusCode(201);
            $return = array($partner->getExpectedArray());
        }
        else {
            $response->setStatusCode(400);
            $errorMessages = array(
                'errors' => $solicitude->getErrorMessages(),
            );
            $return = new JsonModel($errorMessages);
        }
        return new JsonModel(array("result" => $return));
    }
    
    private function _fillSolicitude(array $requestData) {
        $em = $this->getEntityManager();
        $solicitude = new \Solicitude\Entity\Solicitude($this->em);
        if (isset($requestData[0]['nome']) && isset($requestData[0]['email']) && isset($requestData[0]['telefone']) && isset($requestData[0]['data_nascimento']) && isset($requestData[0]['cpf']) && isset($requestData[0]['cep']) && isset($requestData[0]['marca_id'])) {
            $solicitude->setNome($requestData[0]['nome']);
            $solicitude->setEmail($requestData[0]['email']);
            $solicitude->setTelefone($requestData[0]['telefone']);
            $solicitude->setDataNascimento($requestData[0]['data_nascimento']);
            $solicitude->setCpf($requestData[0]['cpf']);
            $solicitude->setCep($requestData[0]['cep']);
            $marca = $this->em->getRepository('Cotacao\Entity\Marca')->findOneBy(array('id' => $data[0]['marca_id']));
            if($marca)
                $solicitude->setMarca($marca);
            else {
                $this->getResponse()->setStatusCode(404);
                return new JsonModel(array("errors" => "Marca não encontrada"));
            }
        }
        else {
            $this->getResponse()->setStatusCode(422);
            $return = new JsonModel(array('errors' => parent::PROCESS_REQUEST_UNPROCESSABLE));
        }                   
        return $atendimento;
    }
}
