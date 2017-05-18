<?php

namespace UserStoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class EmailFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address', EmailType::class, array(
                'label' => 'Email:'
            ))
            ->add('type', ChoiceType::class, array(
                'label' => 'Rodzaj:'
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Dodaj'
            ));
    }

    public function getName()
    {
        return 'email';
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserStoryBundle\Entity\Email'
        ));
    }
}