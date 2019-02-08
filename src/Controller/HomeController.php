<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 16/01/2019
 * Time: 11:03
 */

namespace App\Controller;



use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{



    public function index(PropertyRepository $repository):Response
{
    //dump($this->getUser());
    $propreties=$repository->findlatest();
    return ($this->render('home.html.twig',['properties'=>$propreties]));
}
}