<?php
namespace ThirtyOne\MemberBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use FOS\MessageBundle\Model\ParticipantInterface;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Family
 *
 * @ORM\Entity(repositoryClass="ThirtyOne\MemberBundle\Entity\FamilyRepository")
 * @ORM\Table(name="family")
 */
class Family extends BaseUser implements ParticipantInterface
{
    use ORMBehaviors\Sluggable\Sluggable;
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
     * @ORM\OneToMany(targetEntity="ThirtyOne\MemberBundle\Entity\Event", mappedBy="family")
     */
    private $rallye;

    /**
     * @ORM\ManyToMany(targetEntity="ThirtyOne\MemberBundle\Entity\Event", mappedBy="participant")
     */
    private $events;

    /**
     * @ORM\OneToMany(targetEntity="ThirtyOne\MemberBundle\Entity\Child", mappedBy="family")
     */
    private $child;

    /**
     * @ORM\OneToMany(targetEntity="ThirtyOne\MemberBundle\Entity\Informations", mappedBy="family")
     */
    private $informations;

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
     * @ORM\Column(name="publish", type="boolean")
     */
    private $publish = 0;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getSluggableFields()
    {
        return [ 'username' ];
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

    /**
     * @param string $publish
     */
    public function setPublish($publish)
    {
        $this->publish = $publish;
    }

    /**
     * @return string
     */
    public function getPublish()
    {
        return $this->publish;
    }

    /**
     * @param mixed $informations
     */
    public function setInformations($informations)
    {
        $this->informations = $informations;
    }

    /**
     * @return mixed
     */
    public function getInformations()
    {
        return $this->informations;
    }

    /**
     * @param mixed $rallye
     */
    public function setRallye($rallye)
    {
        $this->rallye = $rallye;
    }

    /**
     * @return mixed
     */
    public function getRallye()
    {
        return $this->rallye;
    }

    /**
     * @param mixed $events
     */
    public function setEvents($events)
    {
        $this->events = $events;
    }

    /**
     * @return mixed
     */
    public function getEvents()
    {
        return $this->events;
    }
}
