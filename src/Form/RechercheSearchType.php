<?php

namespace App\Form;

use App\Entity\Recherche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class RechercheSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price', RangeType::class, [
                'attr' => [
                    'min' => 5000,
                    'max' => 500000,
                     'data-show-value'=>"true"
                ]
            ])
            ->add('token', ChoiceType::class, [
                'choices' => ['vendre' => 'Vendre',
                    'Louer' => 'Louer',],
                'expanded' => true])
            ->add('surface', IntegerType::class, ['attr' => ['class' => 'form-control']])
            ->add('city', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('categ', ChoiceType::class, [
                'choices' => [
                    'Maison' => 'maison',
                    'Appartement' => 'appatement',
                    'Studio' => 'studio'
                    , 'Terrain' => 'terrain',
                    'Immeuble' => 'immeuble',
                    'Chalet,mobil-home' => 'chalet',
                    'Bureau et locaux' => 'bureau',
                    'Fonds du commerce' => 'fond_du_commerce'

                ]
            ])
            ->add('rooms', ChoiceType::class, [
                'choices' => [
                    's+0' => '0',
                    's+1' => '1',
                    's+2' => '2',
                    's+3' => '3',
                    's+4 ou plus' => '4'


                ]
            ])
            ->add('equipement', ChoiceType::class, [
                'choices' => ['Garage' => 'Garage',
                    'Dressing' => 'Dressing',
                    'Jardin' => 'jardin',
                    'Place de parking' => 'place de parking',
                    ' Balcon' => 'balcon'],
                'multiple' => true,

                'expanded' => true, 'choice_attr' => function ($choiceValue, $key, $value) {
                    // adds a class like attending_yes, attending_no, etc
                    return ['class' => 'attending_' . strtolower($key)];
                },])
            ->add('save', SubmitType::class, ['attr' => ['class' => 'btn btn-primary']])
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recherche::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }
    public function getBlockPrefix()
    {
        return ''; // url
    }

}

