<?php

namespace ThirtyOne\MemberBundle\Form\Type;

use Symfony\Component\Form\FormBuilder;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Validator\Constraint\UserPassword as OldUserPassword;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ProfileFormType extends BaseType
{

    public function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildUserForm($builder, $options);

        // custom fields
        $builder->add('civilite', 'hidden', array(
            'label' => 'Civilité',

            ))
            ->add('username', 'hidden', array(
                'label' => 'Nom de famille',
                'read_only' => true
            ))
            ->add('firstname', 'hidden', array(
                'required' => false,
                'label' => 'Prénom'
            ))
            ->add('nbChildren', 'integer', array(
                'label' => 'Nombre d\'enfants'
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
                'label' => 'Région'
            ))
            ->add('city', 'text', array(
                'label' => 'Ville'
            ))
            ->add('phonenumber', 'number', array(
                'label' => 'Numéro de téléphone'
            ));
    }

    public function getName()
    {
        return 'thirtyone_member_profile';
    }
}