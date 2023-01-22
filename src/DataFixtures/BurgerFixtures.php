<?php

namespace App\DataFixtures;

use App\Entity\Burger;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BurgerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $burgers=["Burger Simple","Burger Senegalais","Burger Double","Burger Espagnole","Burger Italien"];
        foreach ($burgers as $key => $value) {
        $burger=new Burger();
            $burger->setNom($value)
                ->setIsArchived(false);
        $burger   ->setPrix("2$key"."00");
        $manager->persist($burger);
      }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
