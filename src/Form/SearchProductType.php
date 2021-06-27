<?php

namespace App\Form;

use App\Entity\Categories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categories', EntityType::class,[
                'class' => Categories::class,
                'label' => false,
                'required' => false,
                'multiple'=> true,
                'attr' =>[
                    'class' => 'js-categories-multiple'
                ]
            ])
            ->add('minprice', IntegerType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'min ...'
                ]
            ])
            ->add('maxprice', IntegerType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'max ...'
                ]
            ])
            ->add('tags', TextType::class, [
                'label' => false,
                'required'=> false,
                'attr' => [
                    'placeholder' => 'tags ...'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
