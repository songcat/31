<?php

namespace ThirtyOne\MemberBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class EventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', 'file', array(
                "label" => "ajouter une photo de couverture*"
            ))
            ->add('name', 'text', array(
                "label" => "nom du rallye*"
            ))
            ->add('date', 'datetime', array(
                'years' => range(date('Y'), date('Y') + 1),
                'label' => 'Date*',
            ))
            ->add('adress', 'text', array(
                "label" => "Adresse",
                'required' => false
            ))
            ->add('city', 'text', array(
                "label" => "Ville",
                'required' => false
            ))
            ->add('region', 'choice', array(
                'choices' => array(
                    'Alsace' => 'Alsace',
                    'Aqutaine' => 'Aqutaine',
                    'Auvergne' => 'Auvergne',
                    'Basse-Normandie' => 'Basse-Normandie',
                    'Bourgogne' => 'Bourgogne',
                    'Bretagne' => 'Bretagne',
                    'Centre' => 'Centre',
                    'Champagne-Ardenne' => 'Champagne-Ardenne',
                    'Corse' => 'Corse',
                    'Franche-Comté' => 'Franche-Comté',
                    'Haute-Normandie' => 'Haute-Normandie',
                    'Île-de-France' => 'Île-de-France',
                    'Languedoc-Roussillon' => 'Languedoc-Roussillon',
                    'Limousin' => 'Limousin',
                    'Lorraine' => 'Lorraine',
                    'Midi-Pyrénées' => 'Midi-Pyrénées',
                    'Nord-Pas-de-Calais' => 'Nord-Pas-de-Calais',
                    'Pays de la Loire' => 'Pays de la Loire',
                    'Picardie' => 'Picardie',
                    'Poitou-Charentes' => 'Poitou-Charentes',
                    'Provence-Alpes-Côte d\'Azur' => 'Provence-Alpes-Côte d\'Azur',
                    'Rhône-Alpes' => 'Rhône-Alpes',
                ),
                'multiple' => false,
                'label' => 'Région',
                'required' => false
            ))
            ->add('description', 'textarea', array(
                "label" => "description*"
            ))
            ->add('private', 'choice', array(
                'choices' => array('0' => 'public', '1' => 'privé'),
                'multiple' => false,
                'expanded' => true,
                'label' => 'confidentialité'
            ))
            ->add('place', 'hidden', array(
                'attr' => array('class' => 'placeValue')
            ))
            ->add('food', 'hidden', array(
                'attr' => array('class' => 'foodValue')
            ))
            ->add('music', 'hidden', array(
                'attr' => array('class' => 'musicValue')
            ))
            ->add('enregistrer', 'submit', array(
                'attr' => array('class' => 'save'),
            ))
            ->getForm();

    }

    public function getName()
    {
        return 'thirtyone_memberbundle_eventformtype';
    }

}
