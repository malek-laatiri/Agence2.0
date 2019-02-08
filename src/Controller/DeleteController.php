<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Property;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

class DeleteController extends AbstractController
{
    private $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function change($id){
        return "xxx_".$id."_deleted";
    }

    /**
     * @Route("/delete/{slug}_{id}", name="delete.delete",requirements={"slug":"[a-z0-9\-]*"})
     * @return Response
     * @param Property $property
     */
    public function delete(Request $request, ObjectManager $manager, $slug, $id,\Swift_Mailer $mailer)
    {
        //$user = $this->container->get('security.context')->getToken()->getUser();
        $connecteduser = $this->getUser()->getId();
        $entityManager = $this->getDoctrine()->getManager();


        $property = $this->repository->find($id);
        $property->setCreatedby($connecteduser);
        dump($property);
        $property->setCreatedby($this->change($id));
        $property->setAllowed(false);
        $property->setDeleted(true);
        $property->setDeletedAt(new \DateTime('now'));
        $entityManager->persist($property);
        $entityManager->flush();

        $message = (new \Swift_Message('deleted'))
            ->setFrom('testagence6@gmail.com')
            ->setTo('malek.laatiri73@gmail.com')
            ->setBody(
                $this->renderView(
                    'emails/registration.html.twig',['x'=>2]
                ))

        ;

        $mailer->send($message);

        return $this->render('delete\index.html.twig');
    }

}
