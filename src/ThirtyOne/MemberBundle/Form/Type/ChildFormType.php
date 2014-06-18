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
            ->add('firstname', 'text', array(
                'label' => 'Prénom'
            ))
            ->add('gender', 'choice', array(
                'choices'   => array('m' => 'male', 'f' => 'female'),
                'multiple'  => false,
                'expanded'  => true,
                'label'     => 'sexe'
            ))
            ->add('age', 'date', array(
                'years' => range(date('Y') - 25, date('Y')),
                'label' => 'Date de naissance'
            ))
            ->add('school', 'text', array(
                'label' => 'Ecole fréquentée'
            ))
            ->add('city', 'text', array(
                'label' => 'Ville actuelle'
            ))
            ->add('photo', 'file', array(
                'label' => 'Photo'
            ))
            ->add('photo1', 'file', array(
                'required'    => false,
                'label' => 'Photo'
            ))
            ->add('photo2', 'file', array(
                'required'    => false,
                'label' => 'Photo'
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
            ->add('music', 'text', array(
                'required'    => false,
                'label' => 'Musique'
            ))
            ->add('cinema', 'text', array(
                'required'    => false,
                'label' => 'Cinéma'
            ))
            ->add('culture', 'text', array(
                'required'    => false,
                'label' => 'Culture'
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
            ->add('place', 'text', array(
                'required'    => false,
                'label' => 'Lieux préférés'
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
