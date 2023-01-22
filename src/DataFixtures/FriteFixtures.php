<?php

namespace App\DataFixtures;

use App\Entity\Frite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FriteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $frites=["1/2 Portion Frite","Portion Frite","Double Portion Frite"];
        foreach ($frites as $key => $value) {
        $frite=new Frite();
            $frite->setNom($value)
                ->setIsArchived(false);
        $frite   ->setPrix(($key+1)."00");
        $manager->persist($frite);
      }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
