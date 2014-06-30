<?php

namespace ThirtyOne\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ThirtyOne\FrontBundle\Entity\mail;
use ThirtyOne\FrontBundle\Form\Type\ContactFormType;

class DefaultController extends Controller
{

    /**
     * @Route("/l-agence.html")
     * @Template()
     */
    public
    function agenceAction()
    {
        return array();
    }

    /**
     * @Route("/presse.html")
     * @Template()
     */
    public
    function presseAction()
    {
        return array();
    }

    /**
     * @Route("/mentions.html")
     * @Template()
     */
    public
    function mentionsAction()
    {
        return array();
    }

    /**
     * @Route("/cgu.html")
     * @Template()
     */
    public
    function cguAction()
    {
        return array();
    }


    /**
     * @Route("/contact.html")
     * @Template()
     */
    public
    function contactAction()
    {
        $form = $this->createForm(new ContactFormType());
        $request = $this->get('request');
        $form->handleRequest($request);
        if ($form->isValid()) {
            $subject = $form['subject']->getData();
            $name = $form['name']->getData();
            $firstname = $form['firstname']->getData();
            $email = $form['mail']->getData();
            $message = \Swift_Message::newInstance()->setSubject('Contact :'.$subject)
                    ->setFrom(array($email => $firstname.' '.$name))
                    ->setTo('anny.valla@gmail.com')
                    ->setBody($this->renderView('ThirtyOneFrontBundle:Default:email.html.twig', array(
                        'name' => $name,
                        'firstname' => $firstname,
                        'email' => $email,
                        'message' => $form['message']->getData()
                    )));
                $this->get('mailer')->send($message);

            return array(
                'success' => 'Votre message a bien été envoyé',
                'form' => $form->createView()
            );
        }
        return array(
            'form' => $form->createView()
        );
    }
}
