<?php

namespace App\Form;

use App\Entity\Batiment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\Chambre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChambreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('num_bat',EntityType::class, [
                'class' => Batiment::class,
                'choice_label' => function($Batiment){
                    return $Batiment->getNumBat()." -- ".$Batiment->getNom();
                },
                
            ])
            // ->add('type')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chambre::class,
        ]);
    }
}
