<?php

namespace Atendimento\Entity;

use DateTime;
/**
 * Atendimento
 *
 * @ORM\Table(name="atendimentos", indexes={@ORM\Index(name="seguradora_fk", columns={"seguradora"})})
 * @ORM\Entity
 */
class Atendimento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime", nullable=true)
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_cliente", type="string", length=45, nullable=true)
     */
    private $nomeCliente;

    /**
     * @var float
     *
     * @ORM\Column(name="valor", type="float", precision=10, scale=0, nullable=true)
     */
    private $valor;

    /**
     * @var \Cotacao\Entity\Seguradora
     *
     * @ORM\ManyToOne(targetEntity="\Cotacao\Entity\Seguradora")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="seguradora", referencedColumnName="id")
     * })
     */
    private $seguradora;



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
     * Set data
     *
     * @param \DateTime $data
     *
     * @return Atendimento
     */
    public function setData($data)
    {
        $this->data = new DateTime($data);

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set nomeCliente
     *
     * @param string $nomeCliente
     *
     * @return Atendimento
     */
    public function setNomeCliente($nomeCliente)
    {
        $this->nomeCliente = $nomeCliente;

        return $this;
    }

    /**
     * Get nomeCliente
     *
     * @return string
     */
    public function getNomeCliente()
    {
        return $this->nomeCliente;
    }

    /**
     * Set valor
     *
     * @param float $valor
     *
     * @return Atendimento
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return float
     */
    public function getValor()
    {
        return $this->valor;
    }

    public function getErrorMessages() {
        return !is_null($this->_inputFilter) ?
        $this->_inputFilter->getMessages() :
        array('errors' => $this->getValidationErrors());
    }
    
    /**
     * Set seguradora
     *
     * @param \Cotacao\Entity\Seguradora $seguradora
     *
     * @return Atendimento
     */
    public function setSeguradora(\Cotacao\Entity\Seguradora $seguradora = null)
    {
        $this->seguradora = $seguradora;

        return $this;
    }

    /**
     * Get seguradora
     *
     * @return \Desconto\Entity\Seguradora
     */
    public function getSeguradora()
    {
        return $this->seguradora;
    }
    
    public function getExpectedArray() {
        return array(
            'data' => $this->getData(),
            'nome_cliente' => $this->getNomeCliente(),
            'seguradora' => $this->getSeguradora(),
            'valor' => $this->getValor()
        );
    }
}
