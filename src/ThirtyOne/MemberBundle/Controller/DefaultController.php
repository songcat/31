<?php

namespace ThirtyOne\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ThirtyOne\MemberBundle\Entity\Family;
use ThirtyOne\MemberBundle\Form\Type\ParrainageFormType;

class DefaultController extends Controller
{

    private function getNewEvents($famevent)
    {
        $date = new \DateTime();
        $region = $this->getUser()->getRegion();
        $rallye = $this->getDoctrine()->getManager()
            ->getRepository('ThirtyOneMemberBundle:Event')
            ->getEvent($region, $date);
        $result = $id = array();
        foreach ($famevent as $e) {
            $id[] = $e->getId();
        }
        foreach ($rallye as $r) {
            if (!in_array($r->getId(), $id)) {
                $result[] = $r;
            }
        }
        return $result;
    }

    /**
     * @Route("/membre.html")
     * @Template()
     */
    public function indexAction()
    {
        $fam = $this->getUser();
        $region = $fam->getRegion();
        $famevent = $this->getUser()->getEvents();
        $eventresult = $this->getNewEvents($famevent);
        //echo '<pre>';
        //\Doctrine\Common\Util\Debug::dump($eventresult);

        $famresult = $this->getDoctrine()->getManager()
            ->getRepository('ThirtyOneMemberBundle:Family')
            ->homeFamily($region, $fam->getId());
        return array(
            'famresult' => $famresult,
        );
    }

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

    /**
     * @Route("/parrainer.html")
     * @Template()
     */
    public function parrainageAction()
    {
        $user = $this->getUser();
        $form = $this->createForm(new ParrainageFormType());
        $name = $user->getUsername();
        $firstname = $user->getFirstname();
        $request = $this->get('request');
        $form->handleRequest($request);
        if ($form->isValid()) {
            $message = \Swift_Message::newInstance()->setSubject($name . ' ' . $firstname . ' vous invite sur trentetun.com')
                ->setFrom(array('parrainage@trentetun.com' => 'Trente & Un'))
                ->setTo($form['email1']->getData(), $form['email2']->getData(),
                    $form['email3']->getData(), $form['email4']->getData(), $form['email5']->getData())
                ->setBody($this->renderView('ThirtyOneMemberBundle:Default:email.html.twig', array(
                    'name' => $name,
                    'firstname' => $firstname,
                    'personnalText' => $form['message']->getData()
                )));
            $this->get('mailer')->send($message);

            // empeche les erreurs dues au local de s'afficher
            return $this->redirect($this->generateUrl('thirtyone_member_default_parrainage'), 301);
        }
        return array(
            'form' => $form->createView()
        );
    }
}
