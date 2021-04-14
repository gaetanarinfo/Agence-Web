<?php

namespace App\Form;

use App\Entity\WebSiteFooterMenu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WebSiteFooterMenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('button', TextType::class, [
                'required' => true
            ])
            ->add('link', TextType::class, [
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WebSiteFooterMenu::class,
            'translation_domain' => 'forms'
        ]);
    }

}
