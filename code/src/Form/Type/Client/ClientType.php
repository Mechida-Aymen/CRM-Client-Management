<?php

// src/Form/ClientType.php

namespace App\Form\Type\Client;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('entreprise', TextType::class)
            ->add('phoneNumber', TextType::class)
            ->add('adressePostale', TextType::class)
            ->add('ville', TextType::class)
            ->add('pays', TextType::class)
            ->add('manager', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
