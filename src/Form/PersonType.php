<?php

namespace App\Form;

use App\Entity\Language;
use App\Entity\Person;
use App\Entity\Role;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, array(
                'label' => "Prénom"
            ))
            ->add('lastName', TextType::class, array(
                'label' => "Nom de famille"))
            ->add('birthDate',BirthdayType::class, array(
                'label' => "Date de naissance"))
            ->add('imageFile', VichImageType::class, array(
                'label' => "Photo du Wilder"
            ))
            ->add('description',TextType::class, array(
                'label' => "description du wilder"
            ))
            ->add('role', EntityType::class, array(
                'class' => Role::class,
                'choice_label' => 'name',
                'label' => 'Rôle'))
            ->add('language', EntityType::class, array(
                'class' => Language::class,
                'choice_label' => 'name',
                'label' => 'Langage'))        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
