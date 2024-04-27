<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', options:[
                'label' => 'Titre de l\'article',
                'constraints' => [
                    new Length(
                        min: 10,
                        max: 100
                    )
                ],
            ])
            ->add('content', options:[
                'label' => 'Contenu de l\'article'
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'constraints' => [
                    new Length(
                        min: 5,
                        max: 50
                    )
                ],
                'label' => 'Auteur de l\'article',
'choice_label' => 'email',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'label' => 'Catégorie de l\'article',
'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
