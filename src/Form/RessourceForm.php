<?php

namespace App\Form;

use App\Entity\Etape;
use App\Entity\Ressource;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RessourceForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intitule')
            ->add('presentation')
            ->add('support', ChoiceType::class, [
                'choices' => [
                    'PDF' => 'pdf',
                    'Vidéo' => 'video',
                    'Audio' => 'audio',
                    'Html' => 'html',
                ],
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('nature', ChoiceType::class, [
                'choices' => [
                    'Formulaire' => 'formulaire',
                    'Guide' => 'guide',
                    'QCM' => 'qcm',
                ],
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('url')
            ->add('etape', EntityType::class, [
                'class' => Etape::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ressource::class,
        ]);
    }
}
