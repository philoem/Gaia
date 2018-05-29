<?php

namespace App\Form;

use App\Entity\Members;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;


class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       
        $builder
            ->add('firstname', TextType::class, ['label' => ' ', 'attr' => ['placeholder' => 'Votre prénom']])
            ->add('lastname', TextType::class, ['label' => ' ', 'attr' => ['placeholder' => 'Votre nom']])
            ->add('username', TextType::class, ['label' => ' ', 'attr' => ['placeholder' => 'Votre pseudonyme']])
            
            ->add('mail',EmailType::class, ['label' => ' ', 'attr' => ['placeholder' => 'Votre email']])
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'password', 'attr' => ['placeholder' => 'Votre mot de passe']),
                'second_options' => array('label' => 'repeatPassword', 'attr' => ['placeholder' => 'Répétez votre mot de passe']),
                'invalid_message' => 'Mot de passe non conforme à celui taper avant'
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Members::class,
           
        ]);
    }
}
