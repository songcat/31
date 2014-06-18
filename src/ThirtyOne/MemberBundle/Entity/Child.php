<?php

namespace ThirtyOne\MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Child
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Child
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
     * @ORM\ManyToOne(targetEntity="ThirtyOne\MemberBundle\Entity\Family", inversedBy="child")
     * @ORM\JoinColumn(nullable=false)
     */
    private $family;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=255)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="age", type="datetime")
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="school", type="string", length=255, nullable=true)
     */
    private $school;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="passion", type="string", length=255, nullable=true)
     */
    private $passion;

    /**
     * @var string
     *
     * @ORM\Column(name="sport", type="string", length=255, nullable=true)
     */
    private $sport;

    /**
     * @var string
     *
     * @ORM\Column(name="travel", type="string", length=255, nullable=true)
     */
    private $travel;

    /**
     * @var string
     *
     * @ORM\Column(name="music", type="string", length=255, nullable=true)
     */
    private $music;

    /**
     * @var string
     *
     * @ORM\Column(name="cinema", type="string", length=255, nullable=true)
     */
    private $cinema;

    /**
     * @var string
     *
     * @ORM\Column(name="culture", type="string", length=255, nullable=true)
     */
    private $culture;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=255, nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="proambition", type="string", length=255, nullable=true)
     */
    private $proambition;

    /**
     * @var string
     *
     * @ORM\Column(name="talentoday", type="string", length=255, nullable=true)
     */
    private $talentoday;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=255, nullable=true)
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=255, nullable=true)
     */
    private $place;


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
     * @return Child
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
     * Set age
     *
     * @param \DateTime $age
     * @return Child
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return \DateTime 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set school
     *
     * @param string $school
     * @return Child
     */
    public function setSchool($school)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get school
     *
     * @return string 
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Child
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
     * @return Child
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
     * Set passion
     *
     * @param string $passion
     * @return Child
     */
    public function setPassion($passion)
    {
        $this->passion = $passion;

        return $this;
    }

    /**
     * Get passion
     *
     * @return string 
     */
    public function getPassion()
    {
        return $this->passion;
    }

    /**
     * Set sport
     *
     * @param string $sport
     * @return Child
     */
    public function setSport($sport)
    {
        $this->sport = $sport;

        return $this;
    }

    /**
     * Get sport
     *
     * @return string 
     */
    public function getSport()
    {
        return $this->sport;
    }

    /**
     * Set travel
     *
     * @param string $travel
     * @return Child
     */
    public function setTravel($travel)
    {
        $this->travel = $travel;

        return $this;
    }

    /**
     * Get travel
     *
     * @return string 
     */
    public function getTravel()
    {
        return $this->travel;
    }

    /**
     * Set music
     *
     * @param string $music
     * @return Child
     */
    public function setMusic($music)
    {
        $this->music = $music;

        return $this;
    }

    /**
     * Get music
     *
     * @return string 
     */
    public function getMusic()
    {
        return $this->music;
    }

    /**
     * Set cinema
     *
     * @param string $cinema
     * @return Child
     */
    public function setCinema($cinema)
    {
        $this->cinema = $cinema;

        return $this;
    }

    /**
     * Get cinema
     *
     * @return string 
     */
    public function getCinema()
    {
        return $this->cinema;
    }

    /**
     * Set culture
     *
     * @param string $culture
     * @return Child
     */
    public function setCulture($culture)
    {
        $this->culture = $culture;

        return $this;
    }

    /**
     * Get culture
     *
     * @return string 
     */
    public function getCulture()
    {
        return $this->culture;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Child
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set proambition
     *
     * @param string $proambition
     * @return Child
     */
    public function setProambition($proambition)
    {
        $this->proambition = $proambition;

        return $this;
    }

    /**
     * Get proambition
     *
     * @return string 
     */
    public function getProambition()
    {
        return $this->proambition;
    }

    /**
     * Set talentoday
     *
     * @param string $talentoday
     * @return Child
     */
    public function setTalentoday($talentoday)
    {
        $this->talentoday = $talentoday;

        return $this;
    }

    /**
     * Get talentoday
     *
     * @return string 
     */
    public function getTalentoday()
    {
        return $this->talentoday;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return Child
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set place
     *
     * @param string $place
     * @return Child
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

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }
}
