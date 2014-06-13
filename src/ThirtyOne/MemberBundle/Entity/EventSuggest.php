<?php

namespace ThirtyOne\MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventSuggest
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class EventSuggest
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
     * @ORM\ManyToOne(targetEntity="ThirtyOne\MemberBundle\Entity\Event", inversedBy="event")
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

    /**
     * @var string
     *
     * @ORM\Column(name="family", type="string", length=255)
     */
    private $family;

    /**
     * @var string
     *
     * @ORM\Column(name="suggest", type="string", length=255)
     */
    private $suggest;


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
     * Set family
     *
     * @param string $family
     * @return EventSuggest
     */
    public function setFamily($family)
    {
        $this->family = $family;

        return $this;
    }

    /**
     * Get family
     *
     * @return string 
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * Set suggest
     *
     * @param string $suggest
     * @return EventSuggest
     */
    public function setSuggest($suggest)
    {
        $this->suggest = $suggest;

        return $this;
    }

    /**
     * Get suggest
     *
     * @return string 
     */
    public function getSuggest()
    {
        return $this->suggest;
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
