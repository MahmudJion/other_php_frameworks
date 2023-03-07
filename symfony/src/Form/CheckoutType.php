<?php

namespace App\Form;

use App\Entity\Checkout;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CheckoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('address', TextType::class)
            ->add('city', TextType::class)
            ->add('state', TextType::class)
            ->add('zip', TextType::class)
            ->add('cardNumber', TextType::class)
            ->add('expirationDate', TextType::class)
            ->add('cvv', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Checkout::class,
        ]);
    }
}
