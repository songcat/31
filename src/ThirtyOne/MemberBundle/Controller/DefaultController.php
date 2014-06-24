<?php

namespace ThirtyOne\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/profil/{params}")
     * @Template()
     */
    public function profilAction($params)
    {
        if (!$this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedHttpException();
        }

        $tab = explode('.', $params);
        $em = $this->getDoctrine()->getManager();
        $fam = $em->getRepository('ThirtyOneMemberBundle:Family')->findOneById($tab[1]);
        if ($fam && $fam->getPublish() == 1){
            return $this->render('ThirtyOneMemberBundle:Default:profil.html.twig', array(
                'fam' => $fam,
            ));
        }
        else {
            return $this->render('ThirtyOneMemberBundle:Default:profil.html.twig', array(
                'error' => 'Pas de famille',
            ));
        }


    }
}
