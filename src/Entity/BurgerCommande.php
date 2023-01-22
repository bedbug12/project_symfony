<?php

namespace App\Entity;

use App\Repository\BurgerCommandeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BurgerCommandeRepository::class)]
class BurgerCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $qteBurger = null;

    #[ORM\ManyToOne(inversedBy: 'burgerCommandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $Commande = null;

    #[ORM\ManyToOne(inversedBy: 'burgerCommandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Burger $burger = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQteBurger(): ?int
    {
        return $this->qteBurger;
    }

    public function setQteBurger(int $qteBurger): self
    {
        $this->qteBurger = $qteBurger;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->Commande;
    }

    public function setCommande(?Commande $Commande): self
    {
        $this->Commande = $Commande;

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
}
