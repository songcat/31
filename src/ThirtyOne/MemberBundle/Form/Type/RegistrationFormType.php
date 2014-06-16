<?php

namespace ThirtyOne\MemberBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // custom fields
        $builder->add('username', 'text', array(
                    'label'=>'Nom de famille'
                ))
                ->add('city', 'text', array(
                    'label'=>'Ville'
                ))
                ->add('photo', 'file', array(
                    'label'=>'Photo de famille'
                ))
                ->add('history', 'textarea', array(
                    'required'    => false,
                    'label'=>'Votre histoire'
                ))
                ->add('activities', 'textarea', array(
                    'required'    => false,
                    'label'=>'Activités en famille'
                ));
    }

    public function getName()
    {
        return 'thirtyone_member_registration';
    }
}