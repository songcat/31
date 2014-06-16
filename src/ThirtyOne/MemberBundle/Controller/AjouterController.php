<?php

namespace ThirtyOne\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ThirtyOne\MemberBundle\Entity\Child;
use ThirtyOne\MemberBundle\Form\Type\ChildFormType;

class AjouterController extends Controller {


    /**
     * @Route("/inscription/ajouter")
     * @Template()
     */
    public function ajouterAction() {
        if (!$this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedHttpException();
        }

        $famId = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $fam = $em->getRepository('ThirtyOneMemberBundle:Family')->findOneById($famId);
        $child = new Child;
        $formChild = $this->createForm(new ChildFormType(), $child);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $formChild->handleRequest($request);

            if ($formChild->isValid()) {
                $child->setFamily($fam);
                $em = $this->getDoctrine()->getManager();
                $em->persist($child);
                $em->flush();
            }
        }

        return $this->render('ThirtyOneMemberBundle:ajouter:ajouter.html.twig', array(
            'formChild' => $formChild->createView(),
            'formChildName' => 'Saisir un enfant'
        ));
    }


}