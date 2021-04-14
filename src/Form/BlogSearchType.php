<?php

namespace App\Form;

use App\Entity\Blog;
use App\Entity\BlogSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Rechercher par titre',
                    'style' => 'text-align: center; margin: 0 auto;',
                ]
            ])
            ->add('categorie', ChoiceType::class, [
                'choices' => $this->getCat(),
                'label' => false,
                'attr' => [
                    'style' => 'text-align: center;'
                ],
            ])
            ->add('createdAt', DateType::class, [
               'widget' => 'single_text',
               'html5' => false,
               'label' => false,
               'required' => false,
               'attr' => ['class' => 'js-datapicker', 'data-field' => 'date', 'placeholder' => 'Dated', 'style' => 'text-align: center;']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BlogSearch::class,
            'translation_domain' => 'forms',
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

    private function getCat()
    {
        $choices = Blog::CAT;
        $output = [];
        foreach($choices as $k => $v)
        {
            $output[$v] = $k;
        }
        return $output;
    }
}
