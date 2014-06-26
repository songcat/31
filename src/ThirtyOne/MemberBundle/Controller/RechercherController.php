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

    /**
     * @Route("/rechercher/resultats/famille")
     * @Template()
     */
    public function getFamilyAction()
    {
        // @TODO must be entityrepo
        $family = !empty($_GET['famille']) ? '%'.$_GET['famille'].'%' : null;
        $region = !empty($_GET['region']) ? '%'.$_GET['region'].'%' : null;
        $fam = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        if ($family && $region) {
            // @TODO for a vaudoo reason it doesn't work with a personal query typing
            $query = $em->createQuery('SELECT f.username, f.region, f.id, f.slug
            FROM ThirtyOneMemberBundle:Family f
            WHERE f.username LIKE :name
                AND f.region LIKE :region
                AND f.id != :fam
                AND f.publish = 1')
                ->setParameter('name', $family)
                ->setParameter('region', $region)
                ->setParameter('fam', $fam->getId());
        } else {
            $query = $em->createQuery('SELECT f.username, f.region, f.id, f.slug
            FROM ThirtyOneMemberBundle:Family f
            WHERE f.publish = 1
                AND f.id != :fam
                AND (f.username LIKE :name
                OR f.region LIKE :region)')
                ->setParameter('name', $family)
                ->setParameter('region', $region)
                ->setParameter('fam', $fam->getId());
        }
        $result = $query->getResult();
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
        // @TODO must be entityrepo
        $region = '%'.$_GET['region'].'%';
        $date = new \DateTime();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT e.name, e.region, e.id, e.slug
            FROM ThirtyOneMemberBundle:Event e
            WHERE e.private = 0
                AND e.region LIKE :region
                AND e.date > :date')
            ->setParameter('region', $region)
            ->setParameter('date', $date);
        $result = $query->getResult();
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