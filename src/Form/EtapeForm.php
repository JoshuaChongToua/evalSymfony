<?php

namespace App\Form;

use App\Entity\Etape;
use App\Entity\Parcours;
use App\Entity\Rendu;
use App\Entity\Ressource;
use App\Repository\RenduRepository;
use App\Repository\RessourceRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtapeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intitule')
            ->add('descriptif')
            ->add('consigne')
            ->add('position')
            ->add('parcours', EntityType::class, [
                'class' => Parcours::class,
                'choice_label' => 'id',
            ]);
    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etape::class,
        ]);


    }
}
