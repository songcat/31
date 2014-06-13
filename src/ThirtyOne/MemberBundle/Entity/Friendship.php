<?php

namespace ThirtyOne\MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Friendship
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Friendship
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="f1", type="integer")
     */
    private $f1;

    /**
     * @var integer
     *
     * @ORM\Column(name="f2", type="integer")
     */
    private $f2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="statut", type="boolean")
     */
    private $statut;


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
     * Set f1
     *
     * @param integer $f1
     * @return Friendship
     */
    public function setF1($f1)
    {
        $this->f1 = $f1;

        return $this;
    }

    /**
     * Get f1
     *
     * @return integer 
     */
    public function getF1()
    {
        return $this->f1;
    }

    /**
     * Set f2
     *
     * @param integer $f2
     * @return Friendship
     */
    public function setF2($f2)
    {
        $this->f2 = $f2;

        return $this;
    }

    /**
     * Get f2
     *
     * @return integer 
     */
    public function getF2()
    {
        return $this->f2;
    }

    /**
     * Set statut
     *
     * @param boolean $statut
     * @return Friendship
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return boolean 
     */
    public function getStatut()
    {
        return $this->statut;
    }
}
