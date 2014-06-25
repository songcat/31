<?php

namespace ThirtyOne\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use ThirtyOne\MemberBundle\Entity\Family;

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

    private function isEmpty($tab)
    {
        if ($tab)
            return ('%' . $tab . '%');
        else
            return ('');
    }

    /**
     * @Route("/rechercher/resultats/famille")
     * @Template()
     */
    public function getFamilyAction()
    {
        $family = $_GET['famille'];
        $region = $_GET['region'];

        $fam = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        if ($family && $region)
            $query = $em->createQuery('SELECT f.username, f.region, f.id
            FROM ThirtyOneMemberBundle:Family f
            WHERE f.username LIKE :name
                AND f.region LIKE :region
                AND f.id != :fam
                AND f.publish = 1')
                ->setParameter('name', $family)
                ->setParameter('region', $region)
                ->setParameter('fam', $fam->getId());
        else
            $query = $em->createQuery('SELECT f.username, f.region, f.id
            FROM ThirtyOneMemberBundle:Family f
            WHERE f.publish = 1
                AND f.id != :fam
                AND f.username LIKE :name
                OR f.region LIKE :region')
                ->setParameter('name', $family)
                ->setParameter('region', $region)
                ->setParameter('fam', $fam->getId());
        $result = $query->getResult();
        if ($result)
            return array(
                'result' => $result
            );
        else
            return array(
                'error' => 'Pas de résultat.'
            );
    }

    /**
     * @Route("/rechercher/resultats/rallye")
     * @Template()
     */
    public function getEventAction()
    {
        $region = $_GET['region'];
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT e.name, e.region, e.id
            FROM ThirtyOneMemberBundle:Event e
            INNER JOIN ThirtyOneMemberBundle:Service s
            ON s.id = e.place
            WHERE e.private = 0
                AND (e.region LIKE :region OR s.region LIKE :region')
            ->setParameter('region', $region);
        $result = $query->getResult();
        if ($result)
            return array(
                'result' => $result
            );
        else
            return array(
                'error' => 'Pas de résultat.'
            );
    }
}