<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Stock;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Dropdown to select the product
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'name', // what is displayed in the dropdown
                'label' => 'Product',
                'placeholder' => 'Select a Product',
            ])

            // Numeric input for quantity
            ->add('quantity', IntegerType::class, [
                'label' => 'Quantity',
                'attr' => [
                    'min' => 0,
                    'placeholder' => 'Enter quantity',
                ],
            ])

            // Optional image path field
            ->add('image', TextType::class, [
                'label' => 'Image Path (e.g. /build/image/LOGO.png)',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Optional: /build/image/LOGO.png',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stock::class,
        ]);
    }
}
