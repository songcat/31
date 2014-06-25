<?php

namespace ThirtyOne\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use ThirtyOne\MemberBundle\Entity\Event;

class EventController extends Controller
{

    private function foreachDate($flag, $events)
    {
        $result = array();
        $date = new \DateTime();
        if ($flag)
            foreach ($events as $e) {
                if ($e->getDate() > $date && $e->getPrivate() == 0)
                    $result[] = $e;
            }
        else
            foreach ($events as $e) {
                if ($e->getDate() <= $date && $e->getPrivate() == 0)
                    $result[] = $e;
            }
        return $result;
    }

    /**
     * @Route("/rallye/creation")
     * @Template()
     */
    public function createAction()
    {
        $rallye = new Event();
        $em = $this->getDoctrine()->getManager();
        $service = $em->getRepository('ThirtyOneMemberBundle:Service')->findAll();
        $request = $this->get('request');
        $fam = $this->getUser();

        $form = $this->createFormBuilder($rallye)
            ->add('file', 'file', array(
                "label" => "ajouter une photo de couverture*"
            ))
            ->add('name', 'text', array(
                "label" => "nom du rallye*"
            ))
            ->add('date', 'datetime', array(
                'years' => range(date('Y'), date('Y') + 1),
                'label' => 'Date*',
            ))
            ->add('adress', 'text', array(
                "label" => "Adresse",
                'required' => false
            ))
            ->add('city', 'text', array(
                "label" => "Ville",
                'required' => false
            ))
            ->add('region', 'choice', array(
                'choices'   => array(
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
                'required'=>false
            ))
            ->add('description', 'textarea', array(
                "label" => "description*"
            ))
            ->add('private', 'choice', array(
                'choices' => array('0' => 'public', '1' => 'privé'),
                'multiple' => false,
                'expanded' => true,
                'label' => 'confidentialité'
            ))
            ->add('place', 'hidden')
            ->add('food', 'hidden')
            ->add('music', 'hidden')
            ->add('enregistrer', 'submit', array(
                'attr' => array('class' => 'save'),
            ))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            if ($request->getMethod() == 'POST') {
                if ($form["place"]->getData()) {
                    $place = $em->getRepository('ThirtyOneMemberBundle:Service')->find($form["place"]->getData());
                    $rallye->setPlace($place);
                }
                if ($form["food"]->getData()) {
                    $food = $em->getRepository('ThirtyOneMemberBundle:Service')->find($form["food"]->getData());
                    $rallye->setFood($food);
                }
                if ($form["music"]->getData()) {
                    $music = $em->getRepository('ThirtyOneMemberBundle:Service')->find($form["music"]->getData());
                    $rallye->setMusic($music);
                }
                if (!$place && (!$form["adress"]->getData() || !$form["city"]->getData() || !$form["region"]->getData()))
                    return array(
                        'form' => $form->createView(),
                        'service' => $service,
                        'error' => 'Merci de choisir un lieu ou de saisir adresse/ville/region.'
                    );
                $rallye->upload();
                $rallye->setFamily($fam);
                $rallye->setParticipant($fam);
                $em->persist($rallye);
                $em->flush();
                return $this->redirect($this->generateUrl('thirtyone_member_event_create'), 301);
            }
        }


        return array(
            'form' => $form->createView(),
            'service' => $service,
        );


    }

    /**
     * @Route("/rallye/{path}", requirements={"path"="null|avenir|passe"}, defaults={"path"="null"})
     * @Template()
     */
    public function HomeAction($path)
    {

        $events = $this->getUser()->getEvents();

        if ($path == 'avenir')
            $events = $this->foreachDate(1, $events);
        else if ($path == 'passe')
            $events = $this->foreachDate(0, $events);

        return array(
            'events' => $events,
            'path' => $path
        );
    }

    /**
     * @Route("/rallye/{slug}")
     * @Template()
     */
    public function ShowAction(Event $event)
    {
        return array(
            'event' => $event,
        );
    }

}