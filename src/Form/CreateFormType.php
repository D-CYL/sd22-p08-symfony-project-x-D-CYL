<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Game;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('image')
            ->add('games', EntityType::class, [
                'class' => Game::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('submit', SubmitType::class, ['label' => 'Create']);

//        $builder->add('emails', CollectionType::class, [// each entry in the array will be an "email" field
//            'entry_type' => CreateFormType::class,
//            // these options are passed to each "email" type
//            'entry_options' => ['attr' => ['class' => 'email-box'],],]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class, Game::class,
        ]);
    }
}
