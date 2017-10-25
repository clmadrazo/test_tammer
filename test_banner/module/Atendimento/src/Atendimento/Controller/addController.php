<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Atendimento\Controller;

use Test\Mvc\Controller\RestfulController;
use Zend\View\Model\JsonModel;
use Zend\Mail;
class AddController extends RestfulController
{
    protected $em;
    protected $_allowedMethod = 'PUT';
    protected $request;
    protected $requestData;
    
    public function addAction()
    {
        //Obs: Vendederos, era para ter colocado no banco de dados
        $vendedores = array
                        (
                            array("Bruno Avelino","bruno@bannet.com.br"),
                            array("Vicente Pinheiro","vicente@bannet.com.br"),
                            array("Sara","sara@bannet.com.br"),
                            array("Ana Karine","ana@bannet.com.br")
                        );
        $selVendedor = $vendedores[array_rand($vendedores, 1)];
        //End Vendedores
        
        $this->request = $this->getRequest();
        $data = $this->processBodyContent($this->request);
        $this->em = $this->getEntityManager();
        $atendimento = $this->_fillAtendimento($data,$selVendedor);
        $this->em->persist($atendimento);
        $this->em->flush();
        $this->getResponse()->setStatusCode(201);
        $return = array($atendimento->getExpectedArray());
        
        return new JsonModel(array("result" => $return));
    }
    
    private function _fillAtendimento(array $requestData, $vendedor) {
        $em = $this->getEntityManager();
        $atendimento = new \Atendimento\Entity\Atendimento($this->em);
        if (isset($requestData[0]['data']) && isset($requestData[0]['seguradora_id']) && isset($requestData[0]['solicitude_id']) && isset($requestData[0]['valor'])) {
            $solicitude = $this->em->getRepository('Solicitude\Entity\Solicitude')->findOneBy(array('id' => $requestData[0]['solicitude_id']));
            
            if(isset($solicitude)){
                $atendimento->setNomeCliente($solicitude->getNome());
                $atendimento->setData($requestData[0]['data']);
                $atendimento->setValor($requestData[0]['valor']);
                $seguradora = $this->em->getRepository('Cotacao\Entity\Seguradora')->findOneBy(array('id' => $data[0]['seguradora_id']));
                if($seguradora){
                    $atendimento->setSeguradora($seguradora);
                    $this->send($vendedor,$solicitude);
                }
                else {
                    $this->getResponse()->setStatusCode(404);
                    $return = $seguradora->getErrorMessages();
                }
            }
            else {
                $this->getResponse()->setStatusCode(404);
                return new JsonModel(array('errors' => "Não existe a solicitude"));
            }
        }
        else {
            $this->getResponse()->setStatusCode(422);
            return new JsonModel(array('errors' => "Faltam campos obrigatórios"));
        }                   
        return $atendimento;
    }
    
    private function send($vendedor,$solicitude) {
        $text = 'Olá, este cliente está interesado em um: ' . $solicitude->getMarca() . '. A continuação seguem dados do cliente: nome '. $solicitude->getNome() .' , email '. $solicitude->getEmail() .' , telefone '. $solicitude->getTelefone() .' , data de nascimento '. $solicitude->getDataNascimento() .' , cpf '. $solicitude->getCpf() .' , cep '. $solicitude->getCep(). '.';
        $emailEnvioVendedor = $vendedor[1];
        
        $text = 'O vendedor '. $vendedor[0] .'<'. $vendedor[1] .'> entrará em contato nas próximas 24 horas';
        $emailEnvioCliente = $solicitude->getEmail();
        
        
        $this->sendMail($text,$emailEnvioVendedor);
        $this->sendMail($text,$emailEnvioCliente);
    }
    
    private function sendMail($text,$emailEnvio){
        $subject = 'Aviso';
        // Instancia classe Zend_Mail
        $mail = new Mail\Message();
        // Mensagem do e-mail
        $mail->setBody($text);
        // Seta remetente
        $mail->setFrom('email@gmail.com', 'Aviso Cotação');
        // Define destinatário
        $mail->addTo($emailEnvio);
        // Assunto do e-mail
        $mail->setSubject($subject);
        
        
        $smtpOptions = new \Zend\Mail\Transport\SmtpOptions();
        
        $smtpOptions->setHost('smtp.gmail.com')
        ->setConnectionClass('login')
        ->setName('smtp.gmail.com')
        ->setConnectionConfig(array(
            'username' => 'email_autenticacao@gmail.com',
            'password' => 'password',
            'ssl' => 'tls',
        ));
        
        $transport = new \Zend\Mail\Transport\Smtp($smtpOptions);
        // Envia o e-mail
        $transport->send($mail);
    }
}
