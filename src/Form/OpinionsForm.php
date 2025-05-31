<?php

namespace App\Form;

use App\Entity\Opinions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class OpinionsForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameNeighbor')
            
            ->add('dateOpinion', DateType::class, [
                'widget' => 'choice',
                'label' => 'Fecha de la información',
                'data' => new \DateTime(),
                'attr' => ['class' => 'date-information'],
            ])
            ->add('body')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Opinions::class,
        ]);
    }
}
