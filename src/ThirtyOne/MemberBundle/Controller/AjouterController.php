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

    private function switch_edit($formType, $id)
    {
        $em = $this->getDoctrine()->getManager();
        if ($id) {
            switch ($formType) {
                case 'Child' :
                    $entity = $em->getRepository('ThirtyOneMemberBundle:Child')->findById($id);
                    break;
                case 'Parent' :
                    $entity = $em->getRepository('ThirtyOneMemberBundle:Parents')->findById($id);
                    break;
                case 'GdParent' :
                    $entity = $em->getRepository('ThirtyOneMemberBundle:Gdparent')->findById($id);
                    break;
            }
            return ($entity);
        }
    }

    /**
     * @Route("/inscription/confirmation")
     * @Template()
     */
    public function confirmationAction()
    {
        return array();
    }

    /**
     * @Route("/profil/famille")
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

        $parent = $em->getRepository('ThirtyOneMemberBundle:Parents')->findByFamily($famId);
        $gdparent = $em->getRepository('ThirtyOneMemberBundle:Gdparent')->findByParents($parent);
        $child = $em->getRepository('ThirtyOneMemberBundle:Child')->findByFamily($famId);

        $nbChildren = $fam->getNbChildren();

        if ($request->getMethod() == 'POST') {
            $formType = $request->get('formType');
            $edit = $request->get('edit');
            $switch = $this->switch_case($formType);
            $switch[1]->handleRequest($request);
            if ($switch[1]->isValid()) {
                $em = $this->getDoctrine()->getManager();
                if ($edit) {
                    $entity = $this->switch_edit($formType, $edit);
                    $entity[0]->setFirstname($switch[1]['firstname']->getData());
                    $em->flush();
                } else {
                    if ($formType != 'GdParent') {
                        $switch[0]->setFamily($fam);
                    } else {
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
                    $switch[0]->upload();
                    $em->persist($switch[0]);
                    $em->flush();
                }
                return $this->redirect($this->generateUrl('thirtyone_member_ajouter_ajouter'), 301);
            }
        }
        if (count($parent) == 2 && count($gdparent == 4) && count($child) == $fam->getnbChildren()) {
            $fam->setPublish(1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($fam);
            $em->flush();
        }

        if ($parent) {
            if ($child && $gdparent)
                return $this->render('ThirtyOneMemberBundle:ajouter:ajouter.html.twig', array(
                    'parent' => $parent,
                    'nbChildren' => $nbChildren,
                    'gdparent' => $gdparent,
                    'child' => $child,
                ));
            else if ($child)
                return $this->render('ThirtyOneMemberBundle:ajouter:ajouter.html.twig', array(
                    'parent' => $parent,
                    'nbChildren' => $nbChildren,
                    'child' => $child,
                ));
            else if ($gdparent)
                return $this->render('ThirtyOneMemberBundle:ajouter:ajouter.html.twig', array(
                    'parent' => $parent,
                    'nbChildren' => $nbChildren,
                    'gdparent' => $gdparent,
                ));

            return $this->render('ThirtyOneMemberBundle:ajouter:ajouter.html.twig', array(
                'parent' => $parent,
                'nbChildren' => $nbChildren,
            ));
        } else if ($child) {
            if ($parent)
                return $this->render('ThirtyOneMemberBundle:ajouter:ajouter.html.twig', array(
                    'parent' => $parent,
                    'nbChildren' => $nbChildren,
                    'child' => $child,
                ));
            else
                return $this->render('ThirtyOneMemberBundle:ajouter:ajouter.html.twig', array(
                    'child' => $child,
                    'nbChildren' => $nbChildren,
                ));
        }

        return $this->render('ThirtyOneMemberBundle:ajouter:ajouter.html.twig', array(
            'nbChildren' => $nbChildren,
        ));
    }

    /**
     * @Route("/profil/getAjax")
     * @Template()
     */
    public
    function getAjaxAction()
    {
        $formType = $this->get('request')->request->get('form');
        $id = $this->get('request')->request->get('id');

        $famId = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();

        $entity = $this->switch_edit($formType, $id);

        if ($formType == 'Parent' || $formType == 'GdParent') {
            $nbParent = count($em->getRepository('ThirtyOneMemberBundle:Parents')->findByFamily($famId));
            if ($formType == 'Parent') {
                if ($nbParent >= 2) {
                    return $this->render('ThirtyOneMemberBundle:ajouter:getAjax.html.twig', array(
                        'formType' => $formType,
                        'error' => 'WTF ? deja deux parents...',
                    ));
                }
            } else {
                if (!$nbParent) {
                    return $this->render('ThirtyOneMemberBundle:ajouter:getAjax.html.twig', array(
                        'formType' => $formType,
                        'error' => 'Vous ne pouvez saisir de grand parent sans parent. Merci d\'en saisir un.',
                    ));
                }
            }
        }

        $form = $this->switch_case($formType)[1];
        $edit = 0;
        if ($id) {
            $edit = $id;
            $form->get('firstname')->setData($entity[0]->getFirstname());
        }
        return $this->render('ThirtyOneMemberBundle:ajouter:getAjax.html.twig', array(
            'form' => $form->createView(),
            'formType' => $formType,
            'edit' => $edit,
        ));
    }
}