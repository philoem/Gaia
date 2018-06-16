<?php

namespace App\Form\Admin;

use App\Entity\Adverts;
use App\Form\Admin\UploadImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('price')
            ->add('town')
            ->add('picturesAdverts', UploadImageType::class, ['required' => false, 'label' => 'Sélectionnez une image pour votre annonce :'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adverts::class,
        ]);
    }
}
