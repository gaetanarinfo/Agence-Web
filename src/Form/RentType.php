<?php

namespace App\Form;

use App\Entity\OptionRent;
use App\Entity\Rent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('surface')
            ->add('rooms')
            ->add('bedrooms')
            ->add('floor')
            ->add('price')
            ->add('heat', ChoiceType::class, [
                'choices' => $this->getChoices()
            ])
            ->add('options', EntityType::class, [
                'class' => OptionRent::class,
                'required' => false,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('pictureFiles', FileType::class, [
                'required' => false,
                'multiple' => true
            ])
            ->add('city')
            ->add('address')
            ->add('postal_code')
            ->add('lat', HiddenType::class)
            ->add('lng', HiddenType::class)
            ->add('available')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rent::class,
            'translation_domain' => 'forms'
        ]);
    }

    private function getChoices()
    {
        $choices = Rent::HEAT;
        $output = [];
        foreach($choices as $k => $v)
        {
            $output[$v] = $k;
        }
        return $output;
    }
}
