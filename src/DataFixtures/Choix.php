<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Choix extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $choix_name=array("Vendre","Louer");
        $arrlength = count($choix_name);

        for ($i=0;$i<$arrlength;$i++){
            $choix=new \App\Entity\Choix();
            $choix->setName($choix_name[$i]);
            $choix->setValue($choix_name[$i]);
        }
        $manager->persist($choix);

        $manager->flush();
    }
}
