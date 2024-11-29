<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'événement',
                'required' => true,
            ])
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date de l\'événement',
                'required' => true,
            ])
            ->add('latitude', NumberType::class, [
                'label' => 'Latitude',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Exemple : 48.8566',
                ],
            ])
            ->add('longitude', NumberType::class, [
                'label' => 'Longitude',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Exemple : 2.3522',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}