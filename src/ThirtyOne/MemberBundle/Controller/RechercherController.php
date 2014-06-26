<?php

namespace ThirtyOne\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class RechercherController extends Controller
{

    /**
     * @Route("/rechercher")
     * @Template()
     */
    public function RechercherAction()
    {
        return array();
    }

    /**
     * @Route("/rechercher/resultats/famille")
     * @Template()
     */
    public function getFamilyAction()
    {
        $family = !empty($_GET['famille']) ? '%' . $_GET['famille'] . '%' : null;
        $region = !empty($_GET['region']) ? '%' . $_GET['region'] . '%' : null;
        $fam = $this->getUser();

        $result = $this->getDoctrine()->getManager()
            ->getRepository('ThirtyOneMemberBundle:Family')
            ->getFamily($family, $region, $fam->getId());
        if ($result)
            return array(
                'result' => $result,
                'searchFam' => $_GET['famille'],
                'searchRegion' => $_GET['region']
            );
        else
            return array(
                'error' => 'Pas de résultat.',
                'searchFam' => $_GET['famille'],
                'searchRegion' => $_GET['region']
            );
    }

    /**
     * @Route("/rechercher/resultats/rallye")
     * @Template()
     */
    public function getEventAction()
    {
        $region = '%' . $_GET['region'] . '%';
        $date = new \DateTime();

        $result = $this->getDoctrine()->getManager()
            ->getRepository('ThirtyOneMemberBundle:Event')
            ->getEvent($region, $date);
        if ($result)
            return array(
                'result' => $result,
                'search' => $_GET['region']
            );
        else
            return array(
                'error' => 'Pas de résultat.',
                'search' => $_GET['region']
            );
    }
}