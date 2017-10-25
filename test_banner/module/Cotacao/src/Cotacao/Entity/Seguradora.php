<?php

namespace Cotacao\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seguradora
 *
 * @ORM\Table(name="seguradoras")
 * @ORM\Entity
 */
class Seguradora
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
     * @ORM\Column(name="nome", type="string", length=20, nullable=true)
     */
    protected $nome;



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
     * @return Seguradora
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
    
    public function getExpectedArray() {
        return array(
            'id' => $this->getId(),
            'nome' => $this->getNome()
        );
    }
    
    public function getErrorMessages() {
        return !is_null($this->_inputFilter) ?
        $this->_inputFilter->getMessages() :
        array('errors' => $this->getValidationErrors());
    }
}
