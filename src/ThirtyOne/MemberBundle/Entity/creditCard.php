<?php

namespace ThirtyOne\MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class creditCard
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
     * min = "12",
     * max = "12",
     * minMessage = "Numéro de carte incorrect",
     * maxMessage = "Numéro de carte incorrect"
     * @ORM\Column(name="card", type="bigint")
     */
    private $card;

    /**
     * @var date
     *
     * @ORM\Column(name="expiration", type="datetime")
     */
    private $expiration;

    /**
     * @var integer
     * min = "3",
     * max = "3",
     * minMessage = "Code de sécurité incorrect",
     * maxMessage = "Code de sécurité incorrect"
     * @ORM\Column(name="code", type="integer")
     */
    private $code;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

}