<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

   
    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\OneToOne(cascade: ['persist'])]
    private ?Burger $burger = null;

    #[ORM\OneToOne(cascade: ['persist'])]
    private ?Menu $menu = null;


    public function getId(): ?int
    {
        return $this->id;
    }


   

    public function getMontant(): ?float
    {
        return $this->montant;
    }
    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getBurger(): ?Burger
    {
        return $this->burger;
    }

    public function setBurger(?Burger $burger): self
    {
        $this->burger = $burger;

        return $this;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }
}
