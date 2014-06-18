<?php

namespace ThirtyOne\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use ThirtyOne\MemberBundle\Entity\Child;
use ThirtyOne\MemberBundle\Entity\Parents;
use ThirtyOne\MemberBundle\Entity\Gdparent;
use ThirtyOne\MemberBundle\Form\Type\ChildFormType;
use ThirtyOne\MemberBundle\Form\Type\ParentFormType;
use ThirtyOne\MemberBundle\Form\Type\GdParentFormType;

class AjouterController extends Controller
{
    private function switch_case($formType)
    {
        switch ($formType) {
            case 'Child' :
                $entity = new Child();
                $form = $this->createForm(new ChildFormType(), $entity);
                break;
            case 'Parent' :
                $entity = new Parents();
                $form = $this->createForm(new ParentFormType(), $entity);
                break;
            case 'GdParent' :
                $entity = new Gdparent();
                $form = $this->createForm(new GdParentFormType($this->getUser()->getId()), $entity);
                break;
        }
        return array($entity, $form);
    }

    /**
     * @Route("/profile/famille")
     * @Template()
     */
    public function ajouterAction()
    {
        if (!$this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedHttpException();
        }

        $request = $this->get('request');
        $famId = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $fam = $em->getRepository('ThirtyOneMemberBundle:Family')->findOneById($famId);

        if ($request->getMethod() == 'POST') {
            $formType = $request->get('formType');

            $switch = $this->switch_case($formType);
            $switch[1]->handleRequest($request);
            if ($switch[1]->isValid()) {
                if ($formType != 'GdParent') {
                    $switch[0]->setFamily($fam);
                }
                else {
                    $selectParent = $switch[1]->getData();
                    $parentId = $em->getRepository('ThirtyOneMemberBundle:Parents')->findById($selectParent->getParents());
                    $nbGdparent = count($em->getRepository('ThirtyOneMemberBundle:Gdparent')->findByParents($parentId));
                    if ($nbGdparent >= '2') {
                        return $this->render('ThirtyOneMemberBundle:ajouter:getAjax.html.twig', array(
                            'formType' => $formType,
                            'error' => 'Vous ne pouvez saisir plus de deux grand parents pour ce parent.',
                        ));
                    }
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($switch[0]);
                $em->flush();
            }
        }

        return array();
    }

    /**
     * @Route("/profile/getAjax")
     * @Template()
     */
    public function getAjaxAction()
    {
        $formType = $this->get('request')->request->get('form');

        $famId = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();

        if ($formType == 'Parent' || $formType == 'GdParent') {
            $nbParent = count($em->getRepository('ThirtyOneMemberBundle:Parents')->findByFamily($famId));
            if ($formType == 'Parent') {
                if ($nbParent >= 2) {
                    return $this->render('ThirtyOneMemberBundle:ajouter:getAjax.html.twig', array(
                        'formType' => $formType,
                        'error' => 'WTF ? deja deux parents...',
                    ));
                }
            }
            else {
                if (!$nbParent){
                    return $this->render('ThirtyOneMemberBundle:ajouter:getAjax.html.twig', array(
                        'formType' => $formType,
                        'error' => 'Vous ne pouvez saisir de grand parent sans parent. Merci d\'en saisir un.',
                    ));
                }
            }
        }

        $form = $this->switch_case($formType)[1];

        return $this->render('ThirtyOneMemberBundle:ajouter:getAjax.html.twig', array(
            'form' => $form->createView(),
            'formType' => $formType,
        ));
    }

}