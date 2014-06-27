<?php

namespace ThirtyOne\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{

    /**
     * @Route("/l-agence")
     * @Template()
     */
    public function agenceAction()
    {
            return array();
    }

    /**
     * @Route("/presse")
     * @Template()
     */
    public function presseAction()
    {
        return array();
    }

    /**
     * @Route("/presse")
     * @Template()
     */
    public function contactAction()
    {
        return array();
    }
}
