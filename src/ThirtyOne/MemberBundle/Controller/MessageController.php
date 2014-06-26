<?php

namespace ThirtyOne\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ThirtyOne\MemberBundle\Entity\Thread;
use FOS\MessageBundle\Provider\ProviderInterface;

class MessageController extends Controller
{
    /**
     * @Route("/messagerie")
     * @Template()

    public function SendToAction()
     * {
     * $composer = $this->get('fos_message.composer');
     * $exp = $this->getUser();
     * $dest = $this->getDoctrine()->getRepository('ThirtyOneMemberBundle:Family')->find(20);
     *
     * $data = array();
     * $form = $this->createFormBuilder($data)
     * ->add('Dest', 'text', array(
     * "label" => "Destinataire"
     * ))
     * ->add('Subject', 'text', array(
     * "label" => "Sujet"
     * ))
     * ->add('Message', 'textarea', array(
     * "label" => "Message"
     * ))
     * ->add('Envoyer', 'submit', array(
     * 'attr' => array('class' => 'save'),
     * ))
     * ->getForm();
     *
     * $request = $this->get('request');
     * $form->handleRequest($request);
     * if ($form->isValid()) {
     * if ($request->getMethod() == 'POST') {
     * $message = $composer->newThread()
     * ->setSender($exp)
     * ->addRecipient($dest)
     * ->setSubject($form["Subject"]->getData())
     * ->setBody($form["Message"]->getData())
     * ->getMessage();
     *
     * $sender = $this->get('fos_message.sender');
     * $sender->send($message);
     * }
     * }
     *
     * return array(
     * 'form' => $form->createView()
     * );
     * }*/

    /**
     * @Route("/messagerie")
     * @Template()
     */
    public function inboxAction()
    {
        $threads = $this->getProvider()->getInboxThreads();
        return array(
            'threads' => $threads
        );
    }

    /**
     * @Route("/messagerie/envoye")
     * @Template()
     */
    public function sentAction()
    {
        $threads = $this->getProvider()->getSentThreads();

        return array(
            'threads' => $threads
        );
    }

    /**
     * @Route("/messagerie/supprime")
     * @Template()
     */
    public function deletedAction()
    {
        $threads = $this->getProvider()->getDeletedThreads();

        return array(
            'threads' => $threads
        );
    }

    /**
     * @Route("/messagerie/thread")
     * @Template()
     */
    public function threadAction($threadId)
    {
        $thread = $this->getProvider()->getThread($threadId);
        $form = $this->container->get('fos_message.reply_form.factory')->create($thread);
        $formHandler = $this->container->get('fos_message.reply_form.handler');

        if ($message = $formHandler->process($form)) {
            return new RedirectResponse($this->container->get('router')->generate('fos_message_thread_view', array(
                'threadId' => $message->getThread()->getId()
            )));
        }

        return array(
            'form' => $form->createView(),
            'thread' => $thread
        );
    }

    /**
     * @Route("/messagerie/nouveau")
     * @Template()
     */
    public function newThreadAction()
    {
        $form = $this->container->get('thirtyone_member_message.new_thread_form.factory')->create();
        $formHandler = $this->container->get('fos_message.new_thread_form.handler');

        if ($message = $formHandler->process($form)) {
            return new RedirectResponse($this->container->get('router')->generate('thirtyone_member_message_thread', array(
                'threadId' => $message->getThread()->getId()
            )));
        }

        return array(
            'form' => $form->createView(),
            'data' => $form->getData()
        );
    }

    /**
     * Deletes a thread
     *
     * @param string $threadId the thread id
     *
     * @return RedirectResponse
     */
    public function deleteAction($threadId)
    {
        $thread = $this->getProvider()->getThread($threadId);
        $this->container->get('fos_message.deleter')->markAsDeleted($thread);
        $this->container->get('fos_message.thread_manager')->saveThread($thread);

        return new RedirectResponse($this->container->get('router')->generate('thirtyone_member_message_inbox'));
    }

    /**
     * Undeletes a thread
     *
     * @param string $threadId
     *
     * @return RedirectResponse
     */
    public function undeleteAction($threadId)
    {
        $thread = $this->getProvider()->getThread($threadId);
        $this->container->get('fos_message.deleter')->markAsUndeleted($thread);
        $this->container->get('fos_message.thread_manager')->saveThread($thread);

        return new RedirectResponse($this->container->get('router')->generate('thirtyone_member_message_inbox'));
    }

    /**
     * Gets the provider service
     *
     * @return ProviderInterface
     */
    protected function getProvider()
    {
        return $this->container->get('fos_message.provider');
    }
}
