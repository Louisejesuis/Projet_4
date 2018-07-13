<?php

namespace App\Form;

use App\Entity\Language;
use App\Entity\Person;
use App\Entity\Role;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('birthDate')
            ->add('picture')
            ->add('description')
            ->add('role', EntityType::class, array(
                'class' => Role::class,
                'choice_label' => 'name'))
            ->add('language', EntityType::class, array(
                'class' => Language::class,
                'choice_label' => 'name'))        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
