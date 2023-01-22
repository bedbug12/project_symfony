<?php

namespace App\Entity;

use App\Repository\DtRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DtRepository::class)]
class Dt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
