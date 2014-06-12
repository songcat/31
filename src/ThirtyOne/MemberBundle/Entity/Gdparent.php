<?php

namespace ThirtyOne\MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gdparent
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Gdparent
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
     * @ORM\ManyToOne(targetEntity="ThirtyOne\MemberBundle\Entity\Family", inversedBy="gdparents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $family;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="birthname", type="string", length=255)
     */
    private $birthname;


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
     * Set firstname
     *
     * @param string $firstname
     * @return Gdparent
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set birthname
     *
     * @param string $birthname
     * @return Gdparent
     */
    public function setBirthname($birthname)
    {
        $this->birthname = $birthname;

        return $this;
    }

    /**
     * Get birthname
     *
     * @return string 
     */
    public function getBirthname()
    {
        return $this->birthname;
    }

    /**
     * @param mixed $family
     */
    public function setFamily($family)
    {
        $this->family = $family;
    }

    /**
     * @return mixed
     */
    public function getFamily()
    {
        return $this->family;
    }
}
