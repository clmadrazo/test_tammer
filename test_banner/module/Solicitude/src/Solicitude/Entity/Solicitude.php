<?php

namespace Solicitude\Entity;
use Zend\Validator;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use DateTime;
/**
 * Solicitude
 *
 * @ORM\Table(name="solicitudes", indexes={@ORM\Index(name="marca_fk", columns={"marca"})})
 * @ORM\Entity
 */
class Solicitude
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     */
    protected $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=false)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone", type="string", length=13, nullable=false)
     */
    protected $telefone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_nascimento", type="date", nullable=false)
     */
    protected $dataNascimento;

    /**
     * @var string
     *
     * @ORM\Column(name="cpf", type="string", length=11, nullable=false)
     */
    protected $cpf;

    /**
     * @var string
     *
     * @ORM\Column(name="cep", type="string", length=5, nullable=false)
     */
    protected $cep;

    /**
     * @var \Cotacao\Entity\Marca
     *
     * @ORM\ManyToOne(targetEntity="Cotacao\Entity\Marca")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="marca", referencedColumnName="id")
     * })
     */
    protected $marca;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Solicitude
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Solicitude
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telefone
     *
     * @param string $telefone
     *
     * @return Solicitude
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get telefone
     *
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set dataNascimento
     *
     * @param \DateTime $dataNascimento
     *
     * @return Solicitude
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = new DateTime($dataNascimento);

        return $this;
    }

    /**
     * Get dataNascimento
     *
     * @return \DateTime
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * Set cpf
     *
     * @param string $cpf
     *
     * @return Solicitude
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get cpf
     *
     * @return string
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set cep
     *
     * @param string $cep
     *
     * @return Solicitude
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get cep
     *
     * @return string
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set marca
     *
     * @param \Cotacao\Entity\Marca $marca
     *
     * @return Solicitudes
     */
    public function setMarca(\Cotacao\Entity\Marca $marca = null)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get marca
     *
     * @return \Cotacao\Entity\Marca
     */
    public function getMarca()
    {
        return $this->marca;
    }
    
    public function isValid()
    {
        if (!$this->_inputFilter) {
            $this->_inputFilter = new InputFilter();
            $email = new Input('email');
            $email->getValidatorChain()
            ->addValidator(new Validator\EmailAddress());
            
            $this->_inputFilter->add($email);
        }
        
        $dirtyData = array(
            'email' => $this->_fields['email']
        );
        $this->_inputFilter->setData($dirtyData);
        
        return $this->_inputFilter->isValid();
    }
    
    public function getExpectedArray() {
        return array(
            'nome' => $this->getNome(),
            'email' => $this->getEmail(),
            'telefone' => $this->getTelefone(),
            'data_nascimento' => $this->getDataNascimento(),
            'cpf' => $this->getCpf(),
            'cep' => $this->getCep(),
            'marca' => $this->getMarca()->getExpectedArray()
        );
    }
    
    public function getErrorMessages() {
        return !is_null($this->_inputFilter) ?
        $this->_inputFilter->getMessages() :
        array('errors' => $this->getValidationErrors());
    }
}
