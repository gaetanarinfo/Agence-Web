<?php

namespace App\Form;

use App\Entity\Blog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
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
            ->add('categorie', ChoiceType::class, [
                'choices' => $this->getCat()
            ])
            ->add('pictureFiles', FileType::class, [
                'required' => false,
                'multiple' => true
            ])
            ->add('author', HiddenType::class)
            ->add('rough_draft', ChoiceType::class, [
                'choices' => $this->getDraft()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
            'translation_domain' => 'forms'
        ]);
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

    private function getDraft()
    {
        $choices = Blog::DRAFT;
        $output = [];
        foreach($choices as $k => $v)
        {
            $output[$v] = $k;
        }
        return $output;
    }
}
