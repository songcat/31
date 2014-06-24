<?php

namespace ThirtyOne\MemberBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChildFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', 'file', array(
                'label' => 'Photo',
                'required' => false,
            ))
            ->add('firstname', 'text', array(
                'label' => 'Prénom*'
            ))
            ->add('gender', 'choice', array(
                'choices'   => array('m' => 'homme', 'f' => 'femme'),
                'multiple'  => false,
                'expanded'  => true,
                'label'     => 'sexe*'
            ))
            ->add('age', 'date', array(
                'years' => range(date('Y') - 30, date('Y')),
                'label' => 'Date de naissance*'
            ))
            ->add('school', 'text', array(
                'required' => false,
                'label' => 'Ecole fréquentée'
            ))

            ->add('passion', 'text', array(
                'required'    => false,
                'label' => 'Passions'
            ))
            ->add('sport', 'text', array(
                'required'    => false,
                'label' => 'Sports pratiqués'
            ))
            ->add('travel', 'text', array(
                'required'    => false,
                'label' => 'Voyage'
            ))
            ->add('price', 'text', array(
                'required'    => false,
                'label' => 'Prix / distinctions'
            ))
            ->add('proambition', 'text', array(
                'required'    => false,
                'label' => 'Ambition professionnelle'
            ))
            ->add('talentoday', 'text', array(
                'required'    => false,
                'label' => 'Talentoday'
            ))
            ->add('language', 'text', array(
                'required'    => false,
                'label' => 'Langues'
            ))
            ->add('Enregistrer', 'submit')->getForm();
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ThirtyOne\MemberBundle\Entity\Child'
        ));
    }

    public function getName()
    {
        return 'thirtyone_memberbundle_childformtype';
    }

}
