<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Category extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $Category_Name=array("Maison","Appartement","Studio","Terrain","Immeuble","Chalet","mobil-home","Bureau et locaux","Fonds du commerce");
        $arrlength = count($Category_Name);

        for ($i=0;$i<$arrlength;$i++){
            $category=new \App\Entity\Category();
             $category->setName($Category_Name[$i]);
            $category->setValue($Category_Name[$i]);
            }
            $manager->persist($category);

        $manager->flush();
    }
}
