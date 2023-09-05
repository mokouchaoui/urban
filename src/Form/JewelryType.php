<?php


namespace App\Form;

use App\Entity\Jewelry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JewelryType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('shortDescription', TextType::class)
            ->add('mainImageUrl', UrlType::class)
            ->add('productSecondaryImageURL', UrlType::class)
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Male' => 'Male',
                    'Female' => 'Female',
                ],
            ])
            ->add('size', TextType::class)
            ->add('color', ChoiceType::class, [
                'choices' => [
                    'Red' => 'Red',
                    'Blue' => 'Blue',
                    'Green' => 'Green',
                ],
                'multiple' => true
            ])
            ->add('metal', ChoiceType::class, [
                'choices' => [
                    'Platinum' => 'Platinum',
                    'Goldtone' => 'Goldtone',
                    'Silver-plated' => 'Silver-plated',
                    'Rose Gold' => 'Rose Gold',
                    'Nickel' => 'Nickel',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Jewelry::class,
        ]);
    }
}
