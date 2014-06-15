<?php

namespace ThirtyOne\MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Event
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
     * @ORM\ManyToOne(targetEntity="ThirtyOne\MemberBundle\Entity\Family", inversedBy="event")
     * @ORM\JoinColumn(nullable=false)
     */
    private $family;

    /**
     * @ORM\OneToMany(targetEntity="ThirtyOne\MemberBundle\Entity\EventComment", mappedBy="comment")
     */
    private $comment;

    /**
     * @ORM\OneToMany(targetEntity="ThirtyOne\MemberBundle\Entity\EventSuggest", mappedBy="suggest")
     */
    private $suggest;


    /**
     * @var string
     *
     * @ORM\Column(name="pack", type="string", length=255)
     */
    private $pack;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=255)
     */
    private $place;

    /**
     * @var array
     *
     * @ORM\Column(name="guest", type="array")
     */
    private $guest;

    /**
     * @var string
     *
     * @ORM\Column(name="information", type="string", length=300)
     */
    private $information;

    /**
     * @var string
     *
     * @ORM\Column(name="theme", type="string", length=255)
     */
    private $theme;


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
     * Set pack
     *
     * @param string $pack
     * @return Event
     */
    public function setPack($pack)
    {
        $this->pack = $pack;

        return $this;
    }

    /**
     * Get pack
     *
     * @return string 
     */
    public function getPack()
    {
        return $this->pack;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Event
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
     * Set date
     *
     * @param \DateTime $date
     * @return Event
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set place
     *
     * @param string $place
     * @return Event
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string 
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set guest
     *
     * @param array $guest
     * @return Event
     */
    public function setGuest($guest)
    {
        $this->guest = $guest;

        return $this;
    }

    /**
     * Get guest
     *
     * @return array 
     */
    public function getGuest()
    {
        return $this->guest;
    }

    /**
     * Set information
     *
     * @param string $information
     * @return Event
     */
    public function setInformation($information)
    {
        $this->information = $information;

        return $this;
    }

    /**
     * Get information
     *
     * @return string 
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * Set theme
     *
     * @param string $theme
     * @return Event
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return string 
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param array $family
     */
    public function setFamily($family)
    {
        $this->family = $family;
    }

    /**
     * @return array
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * @param mixed $suggest
     */
    public function setSuggest($suggest)
    {
        $this->suggest = $suggest;
    }

    /**
     * @return mixed
     */
    public function getSuggest()
    {
        return $this->suggest;
    }
}
