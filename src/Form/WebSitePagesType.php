<?php

namespace App\Form;

use App\Entity\WebSitePages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WebSitePagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true
            ])    
            ->add('link', TextType::class, [
                'required' => true
            ])
            ->add('smallContent', TextareaType::class, [
                'required' => true,
                'attr' => array('style' => 'height: 118px;')
            ])
            ->add('largeContent', TextareaType::class, [
                'required' => true,
                'attr' => array('class' => 'ckeditor')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WebSitePages::class,
            'translation_domain' => 'forms'
        ]);
    }

}
