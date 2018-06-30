<?php

namespace App\Form\Admin;

use App\Entity\Member;
use App\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('lastname', TextType::class)
            ->add('username', TextType::class)
            ->add('mail', EmailType::class)
            //->add('password', RepeatedType::class, array(
            //    'type' => PasswordType::class,
            //    'first_options'  => array('label' => 'password'),
            //    'second_options' => array('label' => 'repeatPassword'),
            //    'invalid_message' => 'Mot de passe non conforme à celui taper avant'))
            ->add('locations', TextType::class)
            ->add('isActive', CheckboxType::class, ['label' => 'Apparaître sur la carte des membres actifs ?', 'required' => false])
            ->add('imageName', FileType::class, ['label' => 'Sélectionnez une image pour votre profil', 'required' => false])
            ->add('lat', TextType::class, ['required' => false])
            ->add('lng', TextType::class, ['required' => false])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
