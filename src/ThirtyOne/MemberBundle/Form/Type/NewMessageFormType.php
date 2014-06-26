<?php

namespace ThirtyOne\MemberBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class NewMessageFormType extends AbstractType
{

    protected $dataDest;

    public function __construct ($dataDest) {
        $this->dataDest = $dataDest;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Dest', 'text', array(
                "label" => "Destinataire",
                "data" => $this->dataDest
            ))
            ->add('Subject', 'text', array(
                "label" => "Sujet"
            ))
            ->add('Message', 'textarea', array(
                "label" => "Message"
            ))
            ->add('Envoyer', 'submit', array(
                'attr' => array('class' => 'save'),
            ))->getForm();
    }

    public function getName()
    {
        return 'thirtyone_memberbundle_parentformtype';
    }

}
