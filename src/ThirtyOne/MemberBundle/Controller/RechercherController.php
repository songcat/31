<?php

namespace ThirtyOne\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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

    /**
     * @Route("/rechercher/getResult/{params}")
     * @Template()
     */
    public function getResultAction($params) {
        $tab = explode('_', $params);
        \Doctrine\Common\Util\Debug::dump($tab);die();
        return $this->render('ThirtyOneMemberBundle:Rechercher:getResult.html.twig', array(
            'family' => $tab[0],
            'region' => $tab[1]
        ));
    }
}