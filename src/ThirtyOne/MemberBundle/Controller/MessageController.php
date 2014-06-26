<?php

namespace ThirtyOne\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ThirtyOne\MemberBundle\Entity\Family;
use ThirtyOne\MemberBundle\Entity\Thread;
use FOS\MessageBundle\Provider\ProviderInterface;
use ThirtyOne\MemberBundle\Form\Type\NewMessageFormType;

class MessageController extends Controller
{
    /**
     * @Route("/message/nouveau/{slug}", defaults={"slug"="null"})
     * @Template()$
     */

    public function SendToAction($slug)
    {
        $composer = $this->get('fos_message.composer');
        $exp = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $fam = $em->getRepository('ThirtyOneMemberBundle:Family')->findOneBySlug($slug);
        $dataDest = $fam ? $fam->getUsername() : '';

        $form = $this->createForm(new NewMessageFormType($dataDest));

        $request = $this->get('request');
        $form->handleRequest($request);
        if ($form->isValid()) {
            if ($request->getMethod() == 'POST') {
                if (!$fam) {
                   $fam = $em->getRepository('ThirtyOneMemberBundle:Family')->findOneByUsername($form["Dest"]->getData());
                }
                $message = $composer->newThread()
                    ->setSender($exp)
                    ->addRecipient($fam)
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
