<?php

namespace ThirtyOne\MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;

    /**
     * @var string
     *
     * @ORM\Column(name="passion", type="string", length=255, nullable=true)
     */
    private $passion;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=255, nullable=true)
     */
    private $price;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * photo
     */

    /**
     * @Assert\File(maxSize="1000000")
     */
    public $file;


    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        $extension = $this->file->guessExtension();
        if (!$extension) {
            // l'extension n'a pas été trouvée
            $extension = 'bin';
        }
        $fileName = time() . '.' . $extension;
        $this->file->move($this->getUploadRootDir(), $fileName);

        $this->path = $fileName;

        // « nettoie » la propriété « file » comme vous n'en aurez plus besoin
        $this->file = null;
    }

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir() . '/' . $this->path;
    }

    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/documents';
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
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
     * Get culture
     *
     * @return string
     */
    public function getCulture()
    {
        return $this->culture;
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

    /**
     * @param string $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }
}
