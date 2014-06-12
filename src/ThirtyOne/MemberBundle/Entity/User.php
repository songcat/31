<?php
/**
 * Created by PhpStorm.
 * User: Valla
 * Date: 12/06/2014
 * Time: 19:51
 */

 // src/ThirtyOne/MemberBundle/Entity/User.php

namespace ThirtyOne\MemberBunlde\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
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
}