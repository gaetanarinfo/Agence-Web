<?php

namespace App\Form;

use App\Entity\WebSiteFooter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WebSiteFooterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('facebook', TextType::class, [
                'required' => true
            ])
            ->add('twitter', TextType::class, [
                'required' => true
            ])
            ->add('instagram', TextType::class, [
                'required' => true
            ])
            ->add('linkedin', TextType::class, [
                'required' => true
            ])
            ->add('address', TextType::class, [
                'required' => true
            ])
            ->add('phone', NumberType::class, [
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WebSiteFooter::class,
            'translation_domain' => 'forms'
        ]);
    }

}
