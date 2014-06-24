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
            ->add('file', 'file', array(
                'label' => 'Photo',
                'required' => false,
            ))
            ->add('gender', 'choice', array(
                'choices'   => array('m' => 'homme', 'f' => 'femme'),
                'multiple'  => false,
                'expanded'  => true,
                'label'     => 'sexe*'
            ))
            ->add('firstname', 'text', array(
                'label' => 'Prénom*'
            ))
            ->add('birthname', 'text', array(
                'label' => 'Nom*'
            ))
            ->add('age', 'integer', array(
                'label' => 'Année de naissance*'
            ))
            ->add('job', 'text', array(
                'label' => 'Métier*'
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
