<?php

namespace App\Form;

use App\Entity\WebSiteMenuPro;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WebSiteMenuProType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('button', TextType::class, [
                'required' => false
            ])
            ->add('link', TextType::class, [
                'required' => false
            ])
            ->add('icon', TextType::class, [
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WebSiteMenuPro::class,
            'translation_domain' => 'forms'
        ]);
    }

}
