<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Room extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $Equipement_name=array("S+0","S+1","S+2","S+3","S+4 OU PLUS");
        $arrlength = count($Equipement_name);

        for ($i=0;$i<$arrlength;$i++){
            $Room=new \App\Entity\Room();
            $Room->setName($Equipement_name[$i]);
            $Room->setValue($Equipement_name[$i]);
        }
        $manager->persist($Room);

        $manager->flush();
    }
}
