<?php

namespace App\Form;

use App\Entity\Card;
use App\Entity\Game;
use App\Entity\user;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('win')
            ->add('player')
            ->add('getDateTime')
            ->add('relation', EntityType::class, [
                'class' => user::class,
'choice_label' => 'id',
            ])
            ->add('cardsPlayer', EntityType::class, [
                'class' => Card::class,
'choice_label' => 'id',
'multiple' => true,
            ])
            ->add('cardsCpu', EntityType::class, [
                'class' => Card::class,
'choice_label' => 'id',
'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
