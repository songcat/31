<?php

namespace ThirtyOne\MemberBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class GdParentFormType extends AbstractType
{
    protected $famId;

    public function __construct ($famId) {
        $this->famId = $famId;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', 'choice', array(
                'choices'   => array('m' => 'homme', 'f' => 'femme'),
                'multiple'  => false,
                'expanded'  => true,
                'label'     => 'sexe'
            ))
            ->add('firstname', 'text', array(
                'label' => 'Prénom'
            ))
            ->add('birthname', 'text', array(
                'required' => false,
                'label' => 'Nom'
            ))
            ->add('birthyear', 'date', array(
                'years' => range(date('Y') - 125, date('Y') - 55),
                'label' => 'Année de naissance'
            ))
            ->add('photo', 'file', array(
                'required' => false,
                'label' => 'photo'
            ))
            ->add('parents', 'entity', array(
                'class'         => 'ThirtyOneMemberBundle:Parents',
                'property'      => 'firstname',
                'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->where('p.family ='. $this->famId);
                    },
                'label' => 'Parent de'
            ))
            ->add('Enregistrer', 'submit')->getForm();;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ThirtyOne\MemberBundle\Entity\Gdparent'
        ));
    }

    public function getName()
    {
        return 'thirtyone_memberbundle_gdparentformtype';
    }

}