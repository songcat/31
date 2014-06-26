<?php

namespace ThirtyOne\MemberBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Message form type for starting a new conversation
 *
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 */
class NewThreadMessageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('recipient', 'fos_user_username', array(
                'label' => 'destinataire'
            ))
            ->add('subject', 'text', array(
                'label' => 'sujet'
            ))
            ->add('body', 'textarea', array(
                'label' => 'message'
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'intention' => 'message',
        ));
    }

    public function getName()
    {
        return 'thirtyone_member_message_thread';
    }
}
