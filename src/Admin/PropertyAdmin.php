<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 20/01/2019
 * Time: 00:29
 */

namespace App\Admin;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Vich\UploaderBundle\Form\Type\VichImageType;


class PropertyAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title', TextType::class)

            ->add('token', ChoiceType::class, ['choices'  => ['vendre' => 'vendre', 'Louer' => 'louer',]])
            ->add('description',TextType::class)
            ->add('surface',TextType::class)
            ->add('categ', ChoiceType::class, ['choices'  => ['Maison' => 'maison', 'Appartement' => 'appatement', 'Studio'=>'studio',                            'Terrain' => 'terrain', 'Immeuble' => 'immeuble', 'Chalet,mobil-home' => 'chalet', 'Bureau et locaux' => 'bureau', 'Fonds du commerce' => 'fond_du_commerce']])
            ->add('equipement', ChoiceType::class, ['choices' => ['Garage'=>'Garage', 'Dressing'=>'Dressing', 'Jardin'=>'jardin', 'Place de parking'=>'place de parking', ' Balcon'=>'balcon'], 'multiple' => true, 'expanded' => true,'choice_attr' => function($choiceValue, $key, $value) {
                    // adds a class like attending_yes, attending_no, etc
                    return ['class' => 'attending_'.strtolower($key)];},])
            ->add('rooms',ChoiceType::class,['choices'  => ['s+0' => '0', 's+1' => '1', 's+2' => '2', 's+3' => '3', 's+4 ou plus' => '4']])
            ->add('bedroom',TextType::class)
            ->add('floor',TextType::class)
            ->add('price',TextType::class)
            ->add('headt',ChoiceType::class,['choices'  => ['gaz' => 'gaz', 'electrique' => 'electrique']])
            ->add('headt',TextType::class)
            ->add('city',TextType::class)
            ->add('address',TextType::class)
            ->add('postal_code',TextType::class)
            ->add('allowed',CheckboxType::class)
            ->add('imageFile',VichImageType::class, [ 'required' => false ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title')
            ->add('token')
            ->add('description')
            ->add('surface')
            ->add('categ')
            ->add('rooms')
            ->add('bedroom')
            ->add('floor')
            ->add( 'price')
            ->add('headt')
            ->add('city')
            ->add('address')
            ->add('postal_code')
            ->add('image')
            ->add('allowed')
            ->add('deleted');

    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title')
            ->addIdentifier('token')
            ->addIdentifier('description')
            ->addIdentifier('surface')
            ->addIdentifier('categ')
            ->addIdentifier('rooms')
            ->addIdentifier('bedroom')
            ->addIdentifier('floor')
            ->addIdentifier( 'price')
            ->addIdentifier('headt')
            ->addIdentifier('city')
            ->addIdentifier('address')
            ->addIdentifier('postal_code')
            ->addIdentifier('image')
            ->addIdentifier('hashid')
            ->addIdentifier('deleted');


    }
}















