<?php

namespace ThirtyOne\FrontBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', 'choice', array(
                'choices'   => array('m' => 'Monsieur', 'f' => 'Madame'),
                'multiple'  => false,
                'expanded'  => true,
                'label'     => false
            ))
            ->add('name', 'text', array(
                "label" => "Nom de famille"
            ))
            ->add('firstname', 'text', array(
                "label" => "Prénom"
            ))
            ->add('mail', 'email', array(
                "label" => "Adresse email"
            ))
            ->add('subject', 'text', array(
                "label" => "Objet du message"
            ))
            ->add('message', 'textarea', array(
                "label" => "Message"
            ))
            ->add('Envoyer', 'submit', array(
                'attr' => array('class' => 'save'),
            ))->getForm();
    }

    public function getName()
    {
        return 'thirtyone_frontbundle_contactformtype';
    }

}