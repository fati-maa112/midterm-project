<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('customer_name', TextType::class, [
                'label' => 'Customer Name',
                'attr' => ['class' => 'form-control']
            ])
            ->add('total', TextType::class, [
                'label' => 'Total Amount',
                'attr' => ['class' => 'form-control']
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Pending' => 'Pending',
                    'Processing' => 'Processing',
                    'Completed' => 'Completed',
                    'Canceled' => 'Canceled',
                ],
                'label' => 'Status',
                'attr' => ['class' => 'form-select']
            ])
            ->add('created_at', HiddenType::class, [
                'data' => (new \DateTime())->format('Y-m-d H:i:s')
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
