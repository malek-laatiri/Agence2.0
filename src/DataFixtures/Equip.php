<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Equip extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $Equipement_name=array("Garage","Dressing","Jardin","Place de Parking","Balcon");
        $arrlength = count($Equipement_name);

        for ($i=0;$i<$arrlength;$i++){
            $Equipement=new \App\Entity\Equip();
            $Equipement->setName($Equipement_name[$i]);
            $Equipement->setValue($Equipement_name[$i]);
        }
        $manager->persist($Equipement);

        $manager->flush();
    }
}
