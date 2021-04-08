<?php

namespace App\Form;

use App\Entity\WebSiteMenuAdmin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WebSiteMenuAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('button1', TextType::class, [
                'required' => false
            ])
            ->add('button2', TextType::class, [
                'required' => false
            ])
            ->add('button3', TextType::class, [
                'required' => false
            ])
            ->add('button4', TextType::class, [
                'required' => false
            ])
            ->add('button5', TextType::class, [
                'required' => false
            ])
            ->add('button6', TextType::class, [
                'required' => false
            ])
            ->add('button7', TextType::class, [
                'required' => false
            ])
            ->add('link1', TextType::class, [
                'required' => false
            ])
            ->add('link2', TextType::class, [
                'required' => false
            ])
            ->add('link3', TextType::class, [
                'required' => false
            ])
            ->add('link4', TextType::class, [
                'required' => false
            ])
            ->add('link5', TextType::class, [
                'required' => false
            ])
            ->add('link6', TextType::class, [
                'required' => false
            ])
            ->add('link7', TextType::class, [
                'required' => false
            ])
            ->add('icon1', TextType::class, [
                'required' => false
            ])
            ->add('icon2', TextType::class, [
                'required' => false
            ])
            ->add('icon3', TextType::class, [
                'required' => false
            ])
            ->add('icon4', TextType::class, [
                'required' => false
            ])
            ->add('icon5', TextType::class, [
                'required' => false
            ])
            ->add('icon6', TextType::class, [
                'required' => false
            ])
            ->add('icon7', TextType::class, [
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WebSiteMenuAdmin::class,
            'translation_domain' => 'forms'
        ]);
    }

}
