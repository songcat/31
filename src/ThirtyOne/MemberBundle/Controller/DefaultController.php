<?php

namespace ThirtyOne\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use ThirtyOne\MemberBundle\Entity\Family;

class DefaultController extends Controller
{
    /**
     * @Route("/profil/{slug}.html")
     * @Template()
     */
    public function profilAction(Family $fam)
    {
        if ($fam && $fam->getPublish() == 1) {
            return array(
                'fam' => $fam,
            );
        } else {
            return array(
                'error' => 'Pas de famille',
            );
        }
    }
}
