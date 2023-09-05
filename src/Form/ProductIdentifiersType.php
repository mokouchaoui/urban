<?php


namespace App\Form;

use App\Entity\ProductIdentifiers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProductIdentifiersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productIdType', ChoiceType::class, [
                'choices' => [
                    'ISBN' => 'ISBN',
                    'GTIN' => 'GTIN',
                    'UPC' => 'UPC',
                    'EAN' => 'EAN'
                ],
            ])
            ->add('productId', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductIdentifiers::class,
        ]);
    }
}
