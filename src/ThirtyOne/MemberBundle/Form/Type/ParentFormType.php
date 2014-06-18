<?php

namespace ThirtyOne\MemberBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ParentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', 'text', array(
                'label' => 'Prénom'
            ))
            ->add('gender', 'choice', array(
                'choices'   => array('m' => 'male', 'f' => 'female'),
                'multiple'  => false,
                'expanded'  => true,
                'label'     => 'sexe'
            ))
            ->add('birthname', 'text', array(
                'required'    => false,
                'label' => 'Nom de jeune fille'
            ))
            ->add('job', 'text', array(
                'required'    => false,
                'label' => 'Métier'
            ))
            ->add('photo', 'file', array(
                'label' => 'photo'
            ))

            ->add('Enregistrer', 'submit')->getForm();
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ThirtyOne\MemberBundle\Entity\Parents'
        ));
    }

    public function getName()
    {
        return 'thirtyone_memberbundle_parentformtype';
    }

}
