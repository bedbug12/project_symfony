<?php

namespace App\DataFixtures;

use App\Entity\Boisson;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BoissonFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $boissons=["Coca Cola","SPRITE","Vimto","Gazelle Pomme","Fanta"];
        foreach ($boissons as $key => $value) {
        $boisson=new Boisson();
            $boisson->setNom($value)
                ->setIsArchived(false);
        $boisson   ->setPrix(($key+3)."00");
        $manager->persist($boisson);
      }
       
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
