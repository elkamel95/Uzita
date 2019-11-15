<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Promos;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\PromosType;
use App\Form\MediaType;
use App\Form\ImagesType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ArticleTypeVol extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('pix')
            ->add('shortdesc',TextareaType::class)
            ->add('descrip',TextareaType::class)
            ->add('dest')
            ->add('datedep')
            ->add('datearriv');

            
          
        
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
