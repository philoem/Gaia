<?php

namespace App\Form\Admin;

use App\Entity\Advert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdvertsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Titre de votre annonce :'])
            ->add('content', TextareaType::class, ['label' => 'Descriptif de votre annonce :'])
            ->add('price', MoneyType::class, ['label' => 'Indiquez ici le prix :'])
            ->add('town', TextType::class, ['label' => 'Et, la ville ici :'])
            ->add('picturesAdverts', FileType::class, [
                'required'  => false,
                'label'     => 'Sélectionnez une image pour votre annonce',
                'mapped'    => false
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Advert::class,
            'validation_groups' => array('registration'),
        ]);
    }
}
