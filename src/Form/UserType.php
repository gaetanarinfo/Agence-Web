<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('password')
            ->add('lastname')
            ->add('firstname')
            ->add('gender', ChoiceType::class, [
                'choices' => $this->getChoices3()
             ])
            ->add('isBanned', ChoiceType::class, [
                'choices' => $this->getChoices()
             ])
             ->add('isActive', ChoiceType::class, [
                'choices' => $this->getChoices2()
             ])
            ->add('city')
            ->add('address')
            ->add('postalCode')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Users' => 'ROLE_USER',
                    'Pro' => 'ROLE_EDITOR',
                    'Admin' => 'ROLE_ADMIN'
                ],
                'expanded' => true,
                'multiple' => true,
                'label' => 'Rôles' 
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

    private function getChoices()
    {
        $choices = USER::BANNED;
        $output = [];
        foreach($choices as $k => $v)
        {
            $output[$v] = $k;
        }
        return $output;
    }

    private function getChoices2()
    {
        $choices = USER::ACTIVE;
        $output = [];
        foreach($choices as $k => $v)
        {
            $output[$v] = $k;
        }
        return $output;
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
