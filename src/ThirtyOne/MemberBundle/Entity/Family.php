<?php

namespace ThirtyOne\MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Family
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Family
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
     * @ORM\OneToMany(targetEntity="ThirtyOne\MemberBundle\Entity\Gdparent", mappedBy="famiy")
     */
    private $gdparents;

    /**
     * @ORM\OneToMany(targetEntity="ThirtyOne\MemberBundle\Entity\Parents", mappedBy="family")
     */
    private $parents;

    /**
     * @ORM\OneToMany(targetEntity="ThirtyOne\MemberBundle\Entity\Child", mappedBy="family")
     */
    private $child;

    /**
     * @ORM\OneToMany(targetEntity="ThirtyOne\MemberBundle\Entity\Event", mappedBy="famiy")
     */
    private $event;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="history", type="string", length=1000)
     */
    private $history;

    /**
     * @var string
     *
     * @ORM\Column(name="activities", type="string", length=255)
     */
    private $activities;


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
     * Set name
     *
     * @param string $name
     * @return Family
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Family
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Family
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Family
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Family
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set history
     *
     * @param string $history
     * @return Family
     */
    public function setHistory($history)
    {
        $this->history = $history;

        return $this;
    }

    /**
     * Get history
     *
     * @return string 
     */
    public function getHistory()
    {
        return $this->history;
    }

    /**
     * Set activities
     *
     * @param string $activities
     * @return Family
     */
    public function setActivities($activities)
    {
        $this->activities = $activities;

        return $this;
    }

    /**
     * Get activities
     *
     * @return string 
     */
    public function getActivities()
    {
        return $this->activities;
    }

    /**
     * @param mixed $gdparents
     */
    public function setGdparents($gdparents)
    {
        $this->gdparents = $gdparents;
    }

    /**
     * @return mixed
     */
    public function getGdparents()
    {
        return $this->gdparents;
    }

    /**
     * @param mixed $child
     */
    public function setChild($child)
    {
        $this->child = $child;
    }

    /**
     * @return mixed
     */
    public function getChild()
    {
        return $this->child;
    }

    /**
     * @param mixed $parents
     */
    public function setParents($parents)
    {
        $this->parents = $parents;
    }

    /**
     * @return mixed
     */
    public function getParents()
    {
        return $this->parents;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }
}
