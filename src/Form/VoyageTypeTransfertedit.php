<?php

namespace App\Form;

use App\Entity\Voyage;
use App\Form\ArticleTypedit;
use App\Form\TransfertType;

use App\Entity\Sejour;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyageTypeTransfertedit extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Article',ArticleTypedit::class)
            ->add('transfert',TransfertType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Voyage::class,
        ]);
    }
}
