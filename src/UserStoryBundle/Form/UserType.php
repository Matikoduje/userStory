<?php
/**
 * Created by PhpStorm.
 * User: mat
 * Date: 13.05.17
 * Time: 12:28
 */

namespace UserStoryBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Podaj imię'
            ))
            ->add('surname', TextType::class, array(
                'label' => 'Podaj nazwisko'
            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Opis'
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Zapisz'
            ));
    }

    public function getName()
    {
        return 'user';
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserStoryBundle\Entity\User'
        ));
    }
}