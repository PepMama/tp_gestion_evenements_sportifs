<?php

namespace App\Form;

use App\Entity\Participant;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label' => "Name",
                'constraints' => [
                     new NotBlank(['message' => 'Veuillez entrer votre nom.']),
                 ],
            ])
            ->add('email', TextType::class,[
                'label' => "Email",
                'constraints' => [
                     new NotBlank(['message' => 'Veuillez entrer votre adresse mail.']),
                 ],
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
