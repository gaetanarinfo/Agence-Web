<?php

namespace App\Form;

use App\Entity\WebSiteMenu2;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WebSiteMenu2Type extends AbstractType
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
            ->add('link1', TextType::class, [
                'required' => false
            ])
            ->add('link2', TextType::class, [
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WebSiteMenu2::class,
            'translation_domain' => 'forms'
        ]);
    }

}
