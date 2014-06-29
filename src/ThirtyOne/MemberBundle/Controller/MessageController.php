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
     * @Template()
     */
    public function newAction($slug)
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

        return array(
            'form' => $form->createView()
        );
    }

    private function generateForm($id)
    {
        return $form = $this->createFormBuilder(array())
            ->add('Message', 'textarea')
            ->add('Répondre', 'submit')
            ->add('Thread', 'hidden', array(
                'data' => $id,
            ))
            ->getForm();
    }

    /**
     * @Route("/message.html")
     * @Template()
     */
    public function getThreadAction()
    {
        $provider = $this->get('fos_message.provider');
        $thread = $provider->getInboxThreads();
        $composer = $this->get('fos_message.composer');
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $postData = $request->request->get('form');
            $threadId = $provider->getThread($postData['Thread']);

            $message = $composer->reply($threadId)
                ->setSender($this->getUser())
                ->setBody($postData['Message'])
                ->getMessage();
            $sender = $this->get('fos_message.sender');
            $sender->send($message);
            return $this->redirect($this->generateUrl('thirtyone_member_message_getthread'), 301);
        }
        return array(
            'thread' => $thread
        );
    }

    /**
     * @Route("/message/getMessage")
     * @Template()
     */
    public function getMessageAction()
    {
        $id = $this->get('request')->request->get('thread');
        $provider = $this->get('fos_message.provider');
        $thread = $provider->getThread($id);

        $form = $this->createFormBuilder(array())
            ->add('Message', 'textarea')
            ->add('Répondre', 'submit')
            ->add('Thread', 'hidden', array(
                'data' => $id,
            ))
            ->getForm();

        return array(
            'thread' => $thread,
            'form' => $form->createView()
        );
    }

    /**
     * @Template()
     */
    public function getUnreadMessageAction()
    {
        $provider = $this->get('fos_message.provider');
        $unreadMessage = $provider->getNbUnreadMessages();

        return array(
            'unreadMessage' => $unreadMessage
        );
    }
}
