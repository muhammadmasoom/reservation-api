<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('departure_time', TextType::class, ['required' => true, 'constraints' => new NotBlank()])
            ->add('departure_airport', TextType::class, ['required' => true,'constraints' => new NotBlank()])
            ->add('destination_airport', TextType::class, ['required' => true,'constraints' => new NotBlank()])
            ->add('seat_number', IntegerType::class, ['required' => true,'constraints' => new NotBlank()])
            ->add('is_active', CheckboxType::class, ['required' => true,'false_values' => ['false', '0']])
            ->add('passport', TextType::class, ['required' => true,'constraints' => new NotBlank()]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true
        ]);
    }
}
