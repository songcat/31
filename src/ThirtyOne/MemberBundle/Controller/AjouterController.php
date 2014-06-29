<?php

namespace ThirtyOne\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use ThirtyOne\MemberBundle\Entity\Child;
use ThirtyOne\MemberBundle\Entity\Informations;
use ThirtyOne\MemberBundle\Entity\Parents;
use ThirtyOne\MemberBundle\Entity\Gdparent;
use ThirtyOne\MemberBundle\Form\Type\ChildFormType;
use ThirtyOne\MemberBundle\Form\Type\ParentFormType;
use ThirtyOne\MemberBundle\Form\Type\GdParentFormType;

class AjouterController extends Controller
{
    private function switch_case($formType, $id)
    {
        if ($id > 0) {
            $em = $this->getDoctrine()->getManager();
            switch ($formType) {
                case 'Child' :
                    $entity = $em->getRepository('ThirtyOneMemberBundle:Child')->find($id);
                    $entity = $entity;
                    $form = $this->createForm(new ChildFormType(), $entity);
                    break;
                case 'Parent' :
                    $entity = $em->getRepository('ThirtyOneMemberBundle:Parents')->find($id);
                    $entity = $entity;
                    $form = $this->createForm(new ParentFormType(), $entity);
                    break;
                case 'GdParent' :
                    $entity = $em->getRepository('ThirtyOneMemberBundle:Gdparent')->find($id);
                    $entity = $entity;
                    $form = $this->createForm(new GdParentFormType($this->getUser()->getId()), $entity);
                    break;
            }
        } else {
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
        }
        return array($entity, $form);
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
        $request = $this->get('request');
        $fam = $this->getUser();
        $famId = $fam->getId();
        $em = $this->getDoctrine()->getManager();

        // @TODO service - getting the right entity
        $parent = $em->getRepository('ThirtyOneMemberBundle:Parents')->findByFamily($famId)
            ? $em->getRepository('ThirtyOneMemberBundle:Parents')->findByFamily($famId) : null;
        $gdparent = $em->getRepository('ThirtyOneMemberBundle:Gdparent')->findByParents($parent)
            ? $em->getRepository('ThirtyOneMemberBundle:Gdparent')->findByParents($parent) : null;
        $child = $em->getRepository('ThirtyOneMemberBundle:Child')->findByFamily($famId)
            ? $em->getRepository('ThirtyOneMemberBundle:Child')->findByFamily($famId) : null;
        $info = $em->getRepository('ThirtyOneMemberBundle:Informations')->findByFamily($famId)
            ? $em->getRepository('ThirtyOneMemberBundle:Informations')->findByFamily($famId)[0] : null;

        $nbChildren = $fam->getNbChildren() ? $fam->getNbChildren() : null;

        if ($request->getMethod() == 'POST') {
            $formType = $request->get('formType');
            if ($formType != 'info') {
                $edit = $request->get('edit');
                $switch = $this->switch_case($formType, $edit);
                $switch[1]->handleRequest($request);
                if ($switch[1]->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    if ($edit > 0) {
                        $switch[0]->upload();
                        $em->flush();
                    } else {
                        if ($formType != 'GdParent') {
                            $switch[0]->setFamily($fam);
                        } else {
                            // verification for gdparents (need to be 2 for a parent)
                            $selectParent = $switch[1]->getData();
                            $parentId = $em->getRepository('ThirtyOneMemberBundle:Parents')->find($selectParent->getParents());
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
            } else {
                $informations = $info ? $info : new Informations();
                $form = $this->createFormBuilder($informations)
                    ->add('file', 'file', array(
                        "label" => "ajouter une photo de couverture",
                        'required' => false
                    ))
                    ->add('history', 'textarea', array(
                        "label" => "histoire de la famille",
                        'required' => false
                    ))
                    ->add('enregistrer', 'submit', array(
                        'attr' => array('class' => 'save'),
                    ))
                    ->getForm();
                $form->handleRequest($request);
                if ($form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    if (!$info) {
                        $informations->upload();
                        $informations->setFamily($fam);
                        $em->persist($informations);
                    } else
                        $info->upload();
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

        return array(
            'info' => $info,
            'parent' => $parent,
            'nbChildren' => $nbChildren,
            'gdparent' => $gdparent,
            'child' => $child,
        );
    }

    /**
     * @Route("/profil/getAjax")
     * @Template()
     */
    public
    function getAjaxAction()
    {
        $formType = $this->get('request')->request->get('form');
        $id = $this->get('request')->request->get('id') ? $this->get('request')->request->get('id') : null;

        $famId = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $edit = 0;

        // @TODO service
        if ($formType != 'info') {
            $entity = $this->switch_case($formType, $id);
            if (($formType == 'Parent' || $formType == 'GdParent') && !$id) {
                $nbParent = count($em->getRepository('ThirtyOneMemberBundle:Parents')->findByFamily($famId));
                if ($formType == 'Parent') {
                    if ($nbParent >= 2) {
                        return array(
                            'formType' => $formType,
                            'error' => 'deja deux parents',
                        );
                    }
                } else {
                    if (!$nbParent) {
                        return array(
                            'formType' => $formType,
                            'error' => 'Vous ne pouvez saisir de grand parent sans parent. Merci d\'en saisir un.',
                        );
                    }
                }
            }
            $form = $entity[1];
            if ($id) {
                $edit = $id;
            }
        } else {
            //$informations = new Informations();
            $informations = $em->getRepository('ThirtyOneMemberBundle:Informations')->findByFamily($famId)
                ? $em->getRepository('ThirtyOneMemberBundle:Informations')->findByFamily($famId)[0] : new Informations();
            $num = $this->get('request')->request->get('num');
            if ($num == 1) {
                $form = $this->createFormBuilder($informations)
                    ->add('file', 'file', array(
                        "label" => "ajouter une photo de couverture"
                    ))
                    ->add('enregistrer', 'submit', array(
                        'attr' => array('class' => 'save'),
                    ))
                    ->getForm();
            } else {
                $form = $this->createFormBuilder($informations)
                    ->add('history', 'textarea', array(
                        "label" => "histoire de la famille"
                    ))
                    ->add('enregistrer', 'submit', array(
                        'attr' => array('class' => 'save'),
                    ))
                    ->getForm();
            }
        }

        return array(
            'form' => $form->createView(),
            'formType' => $formType,
            'edit' => $edit,
        );
    }
}