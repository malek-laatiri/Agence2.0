<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Heat extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $Heat=array("Gaz","Electrique");
        $arrlength = count($Heat);

        for ($i=0;$i<$arrlength;$i++){
            $Room=new \App\Entity\Heat();
            $Room->setName($Heat[$i]);
            $Room->setValue($Heat[$i]);
        }
        $manager->persist($Room);

        $manager->flush();
    }
}
