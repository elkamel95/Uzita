<?php

namespace App\Form;

use App\Entity\Hotel;

use App\Entity\Sejour;
use App\Form\ArticleType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HotelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('etoile')
            ->add('adresse')
                  ->add('aticle',ArticleType::class)
            ->add('sejour',EntityType::class, [
                'class' => Sejour::class,        
                'choice_label' => 'paye',
    
               

                ])->add('topHotel')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hotel::class,
        ]);
    }
}
