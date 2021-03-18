<?php

namespace App\Form;

use App\Entity\Activiteit;
use App\Entity\Soortactiviteit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;


use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoortActiviteitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('naam', TextType::class)
            ->add('beschrijving', TextType::class)
            ->add('prijs', TextType::class, ['attr' => ['type' => 'number']])
            ->add('tijdsduur', TimeType::class, ['attr' => ['class' => 'js-timepicker', 'placeholder'=>'hh:mm'],
                'widget'=>'single_text','html5' => false, 'input' => 'timestamp'])
            ->add('minLeeftijd', TextType::class, ['attr' => ['type' => 'number']]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Soortactiviteit::class,
        ));

    }

}
