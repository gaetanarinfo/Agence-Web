<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType3 extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class, [
                'label' => false,
                'required' => false
            ])
            ->add('firstname', TextType::class, [
                'label' => false,
                'required' => false
            ])
            ->add('gender', ChoiceType::class, [
                'choices' => $this->getChoices3(),
                'label' => false
             ])
            ->add('city', TextType::class, [
                'label' => false,
                'required' => false
            ])
            ->add('address', TextType::class, [
                'label' => false,
                'required' => false
            ])
            ->add('postalCode', IntegerType::class, [
                'label' => false,
                'required' => false
            ])
            ->add('country', CountryType::class, [
                'label' => false,
                'required' => false
            ])
            ->add('phone', TextType::class, [
                'label' => false,
                'required' => false
            ])
            ->add('mobile', TextType::class, [
                'label' => false,
                'required' => false
            ])
            ->add('link', TextType::class, [
                'label' => false
            ])
            ->add('twitter', TextType::class, [
                'label' => false,
                'required' => false
            ])
            ->add('instagram', TextType::class, [
                'label' => false,
                'required' => false
            ])
            ->add('facebook', TextType::class, [
                'label' => false,
                'required' => false
            ])
            ->add('biography', TextareaType::class, [
                'label' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'translation_domain' => 'forms'
        ]);
    }

    private function getChoices3()
    {
        $choices = USER::GENDER;
        $output = [];
        foreach($choices as $k => $v)
        {
            $output[$v] = $k;
        }
        return $output;
    }
}
