<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', options:[
                'label' => 'Adresse Email'
            ])
            ->add('nickname', options:[
                'label' => 'Votre surnom',
                'constraints' => [
                    new Length(
                        min: 5,
                        max: 50
                    )
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                                'mapped' => false,
                                'required' => true,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez acceptez les termes',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'Nouveau mot de passe'],
                'constraints' => [
                    new Regex('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?.!@$%^&*-]).{14,}$/', "Il faut un mot de passe de 14 caractères avec 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial")
                ],
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
