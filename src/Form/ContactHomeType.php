<?php

namespace App\Form;

use App\Entity\Mailbox;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactHomeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'required' => true,
                'label' => false
            ])
            ->add('lastname', TextType::class, [
                'required' => true,
                'label' => false
            ])
            ->add('categorie', ChoiceType::class, [
                'choices' => $this->getChoices(),
                'required' => true,
                'label' => false
            ])
            ->add('subject', TextType::class, [
                'required' => true,
                'label' => false
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => false
            ])
            ->add('phone', TextType::class, [
                'required' => true,
                'label' => false
            ])
            ->add('content', TextareaType::class, [
                'required' => true,
                'label' => false
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mailbox::class,
            'translation_domain' => 'forms'
        ]);
    }

    private function getChoices()
    {
        $choices = Mailbox::CAT;
        $output = [];
        foreach($choices as $k => $v)
        {
            $output[$v] = $k;
        }
        return $output;
    }

}
