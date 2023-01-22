<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $client = new Client();
        $client->setLogin("client@example.com")
            ->setPassword('client');
        $client->setPrenom("Client")
            ->setNom('Cobaye')
            ->setTel("78 166 55 77");

        $manager->persist($client);

        $manager->flush();
    }
}
