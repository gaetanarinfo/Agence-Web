<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType2 extends AbstractType
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
             ->add('isActive', ChoiceType::class, [
                'choices' => $this->getChoices2()
             ])
            ->add('city')
            ->add('address')
            ->add('postalCode')
            ->add('country', CountryType::class, array())
            ->add('phone')
            ->add('mobile')
            ->add('link')
            ->add('twitter')
            ->add('instagram')
            ->add('facebook')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Users' => 'ROLE_USER',
                    'Pro' => 'ROLE_PRO',
                    'Admin' => 'ROLE_ADMIN'
                ],
                'expanded' => true,
                'multiple' => true,
                'label' => 'Rôles' 
            ])
            ->add('avatar', FileType::class,[
                'multiple' => false,
                'mapped' => false,
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
