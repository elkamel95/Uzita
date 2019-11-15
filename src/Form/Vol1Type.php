<?php

namespace App\Form;

use App\Entity\Vol;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\ArticleTypeVol;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class Vol1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('depart')

            ->add('class',ChoiceType::class,[
                'choices'  => [
                    'Business' => 'Business',
                    'First' => 'First',
                    'Autre' => 'Autre',

                ],
            ])
            ->add('adulte')
            ->add('jeune')
                        ->add('time')
                        ->add('timeDarriver')

            ->add('TypeVol',ChoiceType::class,[
                'choices'  => [
                    'Aller(s)-retour(s)' => 1,
                    'Aller(s)
                    ' => 2,
                ],
            ])
            ->add('article',ArticleTypeVol::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vol::class,
        ]);
    }
}
