<?php

namespace App\Form\Admin;

use App\Entity\Members;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Vich\UploaderBundle\Entity\File;

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
            ->add('imageName', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_label' => 'Ci-dessous insérez votre image :',
                'download_uri' => true,
                'image_uri' => true,
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Members::class,
        ]);
    }
}
