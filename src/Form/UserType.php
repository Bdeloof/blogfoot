<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nickname', options:[
            'label' => 'Nom d\'utilisateur'
        ])
        ->add('email', options:[
            'label' => 'Adresse Email'
        ])
        ->add('plainPassword', TextType::class, [
            'mapped' => false,
            'label' => 'Entrez votre mot de passe'
        ])
            ->add('isVerified', CheckboxType::class, [
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
