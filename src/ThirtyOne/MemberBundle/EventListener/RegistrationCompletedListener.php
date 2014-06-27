<?php

namespace ThirtyOne\MemberBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
* Listener responsible to change the redirection at the end of the registration
*/
class RegistrationCompletedListener implements EventSubscriberInterface
{
    private $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    /**
    * {@inheritDoc}
    */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationCompleted',
        );
    }

    public function onRegistrationCompleted($event)
    {
        $url = $this->router->generate('thirtyone_member_ajouter_confirmation');

        $event->setResponse(new RedirectResponse($url));
    }
}