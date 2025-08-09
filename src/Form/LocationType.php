<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('countryCode', ChoiceType::class, [
                'choices' => [
                    'Moldova' => 'MD',
                    'Romania' => 'RO',
                    'Ukraine' => 'UA',
                    'Russia' => 'RU',
                    'Belarus' => 'BY',
                    'Poland' => 'PL',
                    'Germany' => 'DE',
                    'France' => 'FR',
                    'Italy' => 'IT',
                    // Add more countries as needed
                ],
                'placeholder' => 'Select Country Code',
            ])
            ->add('latitude')
            ->add('longitute')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
