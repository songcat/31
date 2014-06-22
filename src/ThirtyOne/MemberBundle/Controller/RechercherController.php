<?php

namespace ThirtyOne\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use ThirtyOne\MemberBundle\Entity\Family;

class RechercherController extends Controller {

    /**
     * @Route("/rechercher")
     * @Template()
     */
    public function RechercherAction()
    {
        $form = $this->createFormBuilder()
            ->add('family', 'text', array(
                'label'=>'Nom de famille',
                'required' => false
            ))
            ->add('region', 'choice', array(
                'choices'   => array(
                    null => '',
                    'Alsace' => 'Alsace',
                    'Aqutaine' => 'Aqutaine',
                    'Auvergne' => 'Auvergne',
                    'Basse-Normandie' => 'Basse-Normandie',
                    'Bourgogne' => 'Bourgogne',
                    'Bretagne' => 'Bretagne',
                    'Centre' => 'Centre',
                    'Champagne-Ardenne' => 'Champagne-Ardenne',
                    'Corse' => 'Corse',
                    'Franche-Comté' => 'Franche-Comté',
                    'Haute-Normandie' => 'Haute-Normandie',
                    'Île-de-France' => 'Île-de-France',
                    'Languedoc-Roussillon' => 'Languedoc-Roussillon',
                    'Limousin' => 'Limousin',
                    'Lorraine' => 'Lorraine',
                    'Midi-Pyrénées' => 'Midi-Pyrénées',
                    'Nord-Pas-de-Calais' => 'Nord-Pas-de-Calais',
                    'Pays de la Loire' => 'Pays de la Loire',
                    'Picardie' => 'Picardie',
                    'Poitou-Charentes' => 'Poitou-Charentes',
                    'Provence-Alpes-Côte d\'Azur' => 'Provence-Alpes-Côte d\'Azur',
                    'Rhône-Alpes' => 'Rhône-Alpes',
                ),
                'multiple'=>false,
                'label'=>'Région',
                'required' => false
            ))
            ->add('rechercher', 'submit')
            ->getForm();

        return $this->render('ThirtyOneMemberBundle:Rechercher:rechercher.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    private function isEmpty($tab) {
        if ($tab)
            return ('%'.$tab.'%');
        else
            return ('');
    }
    /**
     * @Route("/rechercher/getResult/{params}")
     * @Template()
     */
    public function getResultAction($params) {
        $tab = explode('_', $params);
        $tab[0] = $this->isEmpty($tab[0]);
        $tab[1] = $this->isEmpty($tab[1]);
        $em = $this->getDoctrine()->getEntityManager();
        if ($tab[0] && $tab[1])
            $query = $em->createQuery('SELECT f.username, f.region, f.id FROM ThirtyOneMemberBundle:Family f
            WHERE f.username LIKE :name AND f.region LIKE :region AND f.publish = 1')
                ->setParameter('name', $tab[0])
                ->setParameter('region', $tab[1]);
        else
            $query = $em->createQuery('SELECT f.username, f.region, f.id FROM ThirtyOneMemberBundle:Family f
            WHERE f.publish = 1 AND f.username LIKE :name OR f.region LIKE :region')
                     ->setParameter('name', $tab[0])
                     ->setParameter('region', $tab[1]);
        $result = $query->getResult();
        if ($result)
            return $this->render('ThirtyOneMemberBundle:Rechercher:getResult.html.twig', array(
                'result' => $result
            ));
        else
            return $this->render('ThirtyOneMemberBundle:Rechercher:getResult.html.twig', array(
                'error' => 'Pas de résultat.'
            ));
    }
}