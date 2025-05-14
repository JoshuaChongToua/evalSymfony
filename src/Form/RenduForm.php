<?php

namespace App\Form;

use App\Entity\Etape;
use App\Entity\Message;
use App\Entity\Rendu;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RenduForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('url')
            ->add('dateHeure')
            ->add('user_id', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('messages', EntityType::class, [
                'class' => Message::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('etapes', EntityType::class, [
                'class' => Etape::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rendu::class,
        ]);
    }
}
