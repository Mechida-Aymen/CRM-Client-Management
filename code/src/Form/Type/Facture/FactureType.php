<?php

namespace App\Form\Type\Facture;
 
use App\Entity\Facture;
use App\Enum\FactureStatusEnum;
use Symfony\Component\Form\Extension\Core\Type\NumberType; // Import this type
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('facturationDate', DateTimeType::class, [
                'widget' => 'single_text',
                'input' => 'datetime',
            ])
            ->add('amount', null, [
                'label' => 'Amount',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Paid' => FactureStatusEnum::PAID->value, // Enum value stored as string
                    'Unpaid' => FactureStatusEnum::UNPAID->value, // Enum value stored as string
                    'Partially Paid' => FactureStatusEnum::PARTIALLY_PAID->value, // Enum value stored as string
                ],
                'placeholder' => 'Choose a status',
            ])
            ->add('note', TextareaType::class, [
                'required' => false,
                'label' => 'Note',
                'attr' => ['class' => 'form-control'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Facture::class, 
        ]);
    }
}