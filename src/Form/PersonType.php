<?php

namespace App\Form;

use App\Entity\Gender;
use App\Entity\Language;
use App\Entity\Person;
use App\Entity\Role;
use App\Entity\School;
use App\Entity\User;
use Doctrine\DBAL\Types\BigIntType;
use function PHPSTORM_META\type;
use SebastianBergmann\CodeCoverage\Report\Text;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
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
            ->add('gender', EntityType::class, array(
                'class' => Gender::class,
                'choice_label' => 'gender',
                'label' => 'Genre'
            ))
            ->add('birthDate', BirthdayType::class, array(
                'label' => "Date de naissance"))
            ->add('imageFile', VichFileType::class, array(
                'required' => false,
                'allow_delete' => true,
                'download_label' => 'Choisir un fichier',
                'label' => "Photo du Wilder",
            ))
            ->add('role', EntityType::class, array(
                'class' => Role::class,
                'choice_label' => 'name',
                'label' => 'Rôle'))
            ->add('school', EntityType::class, array(
                'class' => School::class,
                'choice_label' => 'name',
                'label' => 'École'
            ))
            ->add('language', EntityType::class, array(
                'class' => Language::class,
                'choice_label' => 'name',
                'label' => 'Langage'))
            ->add('price', TextType::class, array(
                'label' => 'prix'
            ))
            ->add('description', TextType::class, array(
                'label' => "description du wilder"
            ))
            ->add('quality', TextType::class, array(
                'label' => 'Les qualités du wilder'
            ))
            ->add('defect', TextType::class, array(
                'label' => 'Les défauts du wilder'
            ))
            ->add('quote', TextType::class, array(
                'label' => 'citation'
            ))
            ->add('user', EntityType::class, array(
                'class' => User::class,
                'choice_label' => 'username',
                'label' => 'Utilisateur'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
