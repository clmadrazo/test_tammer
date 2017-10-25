<?php

namespace Cotacao\Entity;

use Cotacao\Entity\Marca;
use Cotacao\Entity\Seguradora;
use Doctrine\ORM\Mapping as ORM;

/**
 * Desconto
 *
 * @ORM\Table(name="descontos", indexes={@ORM\Index(name="marca_id_fk", columns={"marca_id"}), @ORM\Index(name="seguradora_id_fk", columns={"seguradora_id"})})
 * @ORM\Entity
 */
class Desconto
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
     * @var float
     *
     * @ORM\Column(name="desconto", type="float", precision=10, scale=0, nullable=true)
     */
    protected $desconto;

    /**
     * @var \Cotacao\Entity\Marca
     *
     * @ORM\ManyToOne(targetEntity="\Cotacao\Entity\Marca")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="marca_id", referencedColumnName="id")
     * })
     */
    protected $marca;

    /**
     * @var \Cotacao\Entity\Seguradora
     *
     * @ORM\ManyToOne(targetEntity="Cotacao\Entity\Seguradora")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="seguradora_id", referencedColumnName="id")
     * })
     */
    protected $seguradora;



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
     * Set desconto
     *
     * @param float $desconto
     *
     * @return Desconto
     */
    public function setDesconto($desconto)
    {
        $this->desconto = $desconto;

        return $this;
    }

    /**
     * Get desconto
     *
     * @return float
     */
    public function getDesconto()
    {
        return $this->desconto;
    }

    /**
     * Set marca
     *
     * @param \Cotacao\Entity\Marca $marca
     *
     * @return Desconto
     */
    public function setMarca(Marca $marca = null)
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

    /**
     * Set seguradora
     *
     * @param \Cotacao\Entity\Seguradora $seguradora
     *
     * @return Desconto
     */
    public function setSeguradora(Seguradora $seguradora = null)
    {
        $this->seguradora = $seguradora;

        return $this;
    }

    /**
     * Get seguradora
     *
     * @return \Cotacao\Entity\Seguradora
     */
    public function getSeguradora()
    {
        return $this->seguradora;
    }
    
    public function getErrorMessages() {
        return !is_null($this->_inputFilter) ?
        $this->_inputFilter->getMessages() :
        array('errors' => $this->getValidationErrors());
    }
}
