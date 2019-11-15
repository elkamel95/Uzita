<?php

namespace App\Form;
use Symfony\Component\HttpFoundation\File;
use App\Entity\Images;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ImagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url',FileType::class, 
[
        'mapped' => false,       
        'multiple' => 'multiple'   ,
     
       ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        
        $resolver->setDefaults([
            
            'data_class' => Images::class
        ]);
    }
}
