<?php

namespace ThirtyOne\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use ThirtyOne\MemberBundle\Entity\Event;

class EventController extends Controller
{

    /**
     * @Route("/rallye/creation")
     * @Template()
     */
    public function createAction()
    {
        if (!$this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedHttpException();
        }

        $rallye = new Event();
        $em = $this->getDoctrine()->getManager();
        $service = $em->getRepository('ThirtyOneMemberBundle:Service')->findAll();
        $request = $this->get('request');
        $famId = $this->getUser()->getId();
        $fam = $em->getRepository('ThirtyOneMemberBundle:Family')->findOneById($famId);

        $form = $this->createFormBuilder($rallye)
            ->add('file', 'file', array(
                "label" => "ajouter une photo de couverture*",
                'required' => false
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
                $place = $food = $music = 0;
                if ($form["place"]->getData())
                    $place = $em->getRepository('ThirtyOneMemberBundle:Service')->findOneById($form["place"]->getData());
                if ($form["food"]->getData())
                    $place = $em->getRepository('ThirtyOneMemberBundle:Service')->findOneById($form["food"]->getData());
                if ($form["music"]->getData())
                    $place = $em->getRepository('ThirtyOneMemberBundle:Service')->findOneById($form["music"]->getData());
                \Doctrine\Common\Util\Debug::dump($place);die();
                $rallye->upload();
                $rallye->setFamily($fam);
                $rallye->setPlace($place);
                $rallye->setFood($food);
                $rallye->setMusic($music);
                $em->persist($rallye);
                $em->flush();
                return $this->redirect($this->generateUrl('thirtyone_member_event_create'), 301);
            }
        }


        return $this->render('ThirtyOneMemberBundle:event:creation.html.twig', array(
            'form' => $form->createView(),
            'service' => $service,
        ));


    }

}