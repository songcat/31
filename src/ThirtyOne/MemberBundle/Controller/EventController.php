<?php

namespace ThirtyOne\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ThirtyOne\MemberBundle\Entity\Event;
use ThirtyOne\MemberBundle\Form\Type\EventFormType;

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
     * @Route("/rallye/creation.html")
     * @Template()
     */
    public function createAction()
    {
        $rallye = new Event();
        $em = $this->getDoctrine()->getManager();
        $service = $em->getRepository('ThirtyOneMemberBundle:Service')->findAll();
        $request = $this->get('request');
        $fam = $this->getUser();

        $form = $this->createForm(new EventFormType(), $rallye);

        $form->handleRequest($request);
        if ($form->isValid()) {
            \Doctrine\Common\Util\Debug::dump($form["place"]->getData());
            if ($form["place"]->getData()) {
                $place = $em->getRepository('ThirtyOneMemberBundle:Service')->find($form["place"]->getData());
                $rallye->setPlace($place);
                $rallye->setRegion($place->getRegion());
                $rallye->setAdress($place->getAdress());
                $rallye->setCity($place->getCity());
            }
            if ($form["food"]->getData()) {
                $food = $em->getRepository('ThirtyOneMemberBundle:Service')->find($form["food"]->getData());
                $rallye->setFood($food);
            }
            if ($form["music"]->getData()) {
                $music = $em->getRepository('ThirtyOneMemberBundle:Service')->find($form["music"]->getData());
                $rallye->setMusic($music);
            }
            if (!$form["place"]->getData() && (!$form["adress"]->getData() && !$form["city"]->getData() && !$form["region"]->getData()))
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
            return $this->redirect($this->generateUrl('thirtyone_member_event_show', array('slug'=>$rallye->getSlug())), 301);
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
     * @Template()
     */
    public function participateAction($eventId, $part)
    {
        $events = $this->getUser()->getEvents();
        $em = $this->getDoctrine()->getManager();
        $rallye = $em->getRepository('ThirtyOneMemberBundle:Event')->find($eventId);
        $participants = $rallye->getParticipant();
        $id = array();

        foreach ($events as $e) {
            $id[] = $e->getId();
        }

        if (in_array($eventId, $id))
            return array(
                'part' => $part,
                'participe' => true,
                'participants' => $participants
            );

        return array(
            'part' => $part,
            'eventId' => $eventId,
            'participants' => $participants
        );
    }

    /**
     * @Route("/rallye/AddParticipant{eventId}")
     */
    public function registerInEventAction($eventId)
    {
        $em = $this->getDoctrine()->getManager();
        $rallye = $em->getRepository('ThirtyOneMemberBundle:Event')->find($eventId);

        $rallye->setParticipant($this->getUser());
        $em->flush();

        return $this->redirect($this->generateUrl('thirtyone_member_event_show', array('slug'=>$rallye->getSlug())), 301);
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

    /**
     * @Template()
     */
    public function getCmdAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cmd = $em->getRepository('ThirtyOneMemberBundle:Event')->findByFamily($this->getUser());

        return array(
            'cmd' => $cmd,
        );
    }

}
