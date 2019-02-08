<?php

namespace App\Controller;

use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;






class ContactController extends AbstractController
{
    /**
     * @return Response
     */
    public function create(Request $request,ObjectManager $manager,\Swift_Mailer $mailer){
        //$user = $this->container->get('security.context')->getToken()->getUser();
        $connecteduser=$this->getUser()->getId();
        dump($connecteduser);

        $property=new Property();
        $property->setCreatedby($connecteduser);
        $form=$this->createFormBuilder($property)

            ->add('token', ChoiceType::class, [
                'choices' => ['vendre' => 'Vendre', 'Louer' => 'Louer','acheter'=>'acheter'], 'expanded' => true])
            ->add('title',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('Description',TextType::class,['attr'=>['class'=>'form-control']])

            ->add('surface',IntegerType::class,['attr'=>['class'=>'form-control']])
            ->add('categ', ChoiceType::class, [
                'choices'  => ['Maison' => 'maison', 'Appartement' => 'appatement', 'Studio'=>'studio','Terrain' => 'terrain',
                    'Immeuble' => 'immeuble', 'Chalet,mobil-home' => 'chalet', 'Bureau et locaux' => 'bureau', 'Fonds du commerce' => 'fond_du_commerce']
                 ])
            ->add('rooms',ChoiceType::class,[
                'choices'  => ['s+0' => '0', 's+1' => '1', 's+2' => '2', 's+3' => '3', 's+4 ou plus' => '4']])
            ->add('bedroom',IntegerType::class,['attr'=>['class'=>'form-control']])
            ->add('floor',IntegerType::class,['attr'=>['class'=>'form-control']])
            ->add('price',MoneyType::class,['attr'=>['class'=>'form-control']])
            ->add('headt',ChoiceType::class,[
                'choices'  => ['gaz' => 'gaz', 'electrique' => 'electrique'
                ]
            ])
            ->add('city',TextType::class,['attr'=>['class'=>'form-control']])

            ->add('address',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('postal_code',IntegerType::class,['attr'=>['class'=>'form-control']])
            ->add('imageFile',VichFileType::class,['attr'=>['class'=>'form-control']])
            ->add('equipement', ChoiceType::class, [
                'choices' => ['Garage'=>'Garage',
                    'Dressing'=>'Dressing',
                    'Jardin'=>'jardin',
                    'Place de parking'=>'place de parking',
                    ' Balcon'=>'balcon'],
                'multiple' => true,

                'expanded' => true,'choice_attr' => function($choiceValue, $key, $value) {
                    // adds a class like attending_yes, attending_no, etc
                    return ['class' => 'attending_'.strtolower($key)];
                },])

            ->add('save',SubmitType::class,['attr'=>['class'=>'btn btn-primary']])

            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted()) {

            $title=$form['title']->getData();
            $Description=$form['Description']->getData();
            $surface=$form['surface']->getData();
            $rooms=$form['rooms']->getData();
            $bedroom=$form['bedroom']->getData();
            $floor=$form['floor']->getData();
            $price=$form['price']->getData();
            $headt=$form['headt']->getData();
            $city=$form['city']->getData();
            $address=$form['address']->getData();
            $postal_code=$form['postal_code']->getData();
            $imageFile=$form['imageFile']->getData();
            $categ=$form['categ']->getData();
            $type=$form['token']->getData();
            $equipement=$form['equipement']->getData();



            $property->setTitle($title);
            $property->setDescription($Description);
            $property->setToken($type);
            $property->setSurface($surface);
            $property->setRooms($rooms);
            $property->setBedroom($bedroom);
            $property->setFloor($floor);
            $property->setCateg($categ);
            $property->setPrice($price);
            $property->setHeadt($headt);
            $property->setCity($city);
            $property->setEquipement($equipement);
            $property->setAddress($address);
            $property->setPostalCode($postal_code);
            $property->setImageFile($imageFile);
            dump($property);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($property);
            $entityManager->flush();


            $message = (new \Swift_Message('new'))
                ->setFrom('testagence6@gmail.com')
                ->setTo('malek.laatiri73@gmail.com')
                ->setBody(
                    $this->renderView(
                        'emails/registration.html.twig',['x'=>1]
                    ))

            ;

            $mailer->send($message);


            dump($entityManager);
            return $this->redirectToRoute('task_success');


        }

        return $this->render('contact/index.html.twig',['formmaison'=>$form->createView()]);
    }


    public function index():Response{
        return $this->render('return.html.twig');
    }




}