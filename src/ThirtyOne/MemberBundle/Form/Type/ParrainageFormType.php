<?php

namespace ThirtyOne\MemberBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class ParrainageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email1', 'email', array(
                "label" => "Famille 1"
            ))
            ->add('email2', 'email', array(
                "label" => "Famille 2",
                'required' => false
            ))
            ->add('email3', 'email', array(
                "label" => "Famille 3",
                'required' => false
            ))
            ->add('email4', 'email', array(
                "label" => "Famille 4",
                'required' => false
            ))
            ->add('email5', 'email', array(
                "label" => "Famille 5",
                'required' => false
            ))
            ->add('message', 'textarea', array(
                "label" => 'joignez un message personnel à votre invitation',
                "required" => false
            ))
            ->add('envoyer', 'submit', array(
                'attr' => array('class' => 'save'),
            ))
            ->getForm();

    }

    public function getName()
    {
        return 'thirtyone_memberbundle_parrainageformtype';
    }

}
