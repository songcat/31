<?php
namespace ThirtyOne\MemberBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Family
 *
 * @ORM\Entity
 * @ORM\Table(name="family")
 */
class Family extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @ORM\OneToMany(targetEntity="ThirtyOne\MemberBundle\Entity\Parents", mappedBy="family")
     */
    private $parents;

    /**
     * @ORM\OneToMany(targetEntity="ThirtyOne\MemberBundle\Entity\Child", mappedBy="family")
     */
    private $child;

    /**
     * @ORM\OneToMany(targetEntity="ThirtyOne\MemberBundle\Entity\Event", mappedBy="family")
     */
    private $event;

    /**
     * @var string
     *
     * @ORM\Column(name="civilite", type="string", length=255)
     */
    private $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbChildren", type="integer")
     */
    private $nbChildren;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="phonenumber", type="text", length=15)
     */
    private $phonenumber;


    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="history", type="string", length=1000, nullable=true)
     */
    private $history;

    /**
     * @var string
     *
     * @ORM\Column(name="activities", type="string", length=255, nullable=true)
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

    /**
     * @param string $civilite
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;
    }

    /**
     * @return string
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $nbChildren
     */
    public function setNbChildren($nbChildren)
    {
        $this->nbChildren = $nbChildren;
    }

    /**
     * @return string
     */
    public function getNbChildren()
    {
        return $this->nbChildren;
    }

    /**
     * @param string $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $phonenumber
     */
    public function setPhonenumber($phonenumber)
    {
        $this->phonenumber = $phonenumber;
    }

    /**
     * @return string
     */
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }
}
