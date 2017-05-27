<?php
/**
 * Created by PhpStorm.
 * Person: mat
 * Date: 13.05.17
 * Time: 14:10
 */

namespace UserStoryBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', TextType::class, array(
                'label' => 'Miasto:'
            ))
            ->add('street', TextType::class, array(
                'label' => 'Ulica:'
            ))
            ->add('houseNumber', NumberType::class, array(
                'label' => 'Numer Domu:'
            ))
            ->add('flatNumber', NumberType::class, array(
                'label' => 'Numer Mieszkania:'
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Zapisz'
            ));
    }

    public function getName()
    {
        return 'adress';
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserStoryBundle\Entity\Adress'
        ));
    }
}