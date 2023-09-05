<?php

namespace App\Form;

use App\Entity\Orderable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class OrderableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sku', TextType::class)
            ->add('productIdentifiers', ProductIdentifiersType::class)
            ->add('productName', TextType::class)
            ->add('brand', TextType::class)
            ->add('price', NumberType::class)
            ->add('shippingWeight', NumberType::class)
            ->add('mustShipAlone', ChoiceType::class,[
                'choices' => [
                    'Yes' => 'Yes',
                    'No' => 'No',
                ],
            ])
            ->add('skuUpdate', ChoiceType::class,[
                'choices' => [
                    'Yes' => 'Yes',
                    'No' => 'No',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Orderable::class,
        ]);
    }
}
    