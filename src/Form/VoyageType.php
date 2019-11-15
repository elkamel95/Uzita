<?php

namespace App\Form;

use App\Entity\Voyage;
use App\Form\ArticleType;
use App\Entity\Sejour;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Article',ArticleType::class)
            
             ->add('sejour',EntityType::class, [
                'class' => Sejour::class,        
                'choice_label' => 'paye'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Voyage::class,
        ]);
    }
}
