<?php

namespace ThirtyOne\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ThirtyOne\MemberBundle\Entity\Thread;

class MessageController extends Controller
{
    /**
     * @Route("/messagerie")
     * @Template()
     */
    public function SendToAction()
    {
        $composer = $this->get('fos_message.composer');
        $exp = $this->getUser();
        $dest = $this->getDoctrine()->getRepository('ThirtyOneMemberBundle:Family')->find(20);

        $data = array();
        $form = $this->createFormBuilder($data)
            ->add('Dest', 'text', array(
                "label" => "Destinataire"
            ))
            ->add('Subject', 'text', array(
                "label" => "Sujet"
            ))
            ->add('Message', 'textarea', array(
                "label" => "Message"
            ))
            ->add('Envoyer', 'submit', array(
                'attr' => array('class' => 'save'),
            ))
            ->getForm();

        $request = $this->get('request');
        $form->handleRequest($request);
        if ($form->isValid()) {
            if ($request->getMethod() == 'POST') {
                $message = $composer->newThread()
                    ->setSender($exp)
                    ->addRecipient($dest)
                    ->setSubject($form["Subject"]->getData())
                    ->setBody($form["Message"]->getData())
                    ->getMessage();

                $sender = $this->get('fos_message.sender');
                $sender->send($message);
            }

        }

        return array(
            'form' => $form->createView()
        );
    }
}
