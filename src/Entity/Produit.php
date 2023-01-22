<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
#[InheritanceType("JOINED")]
#[DiscriminatorColumn("type")]
#[DiscriminatorMap([
   "burger"=>"Burger",
   "menu"=>"Menu",
   "complement"=>"Complement"
])]

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
abstract class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(length: 255)]
    protected ?string $nom = null;

    #[ORM\Column]
    protected ?bool $isArchived = null;

    #[ORM\OneToOne(mappedBy: 'produit', cascade: ['persist', 'remove'])]
    protected ?Image $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id=$id;
        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function isIsArchived(): ?bool
    {
        return $this->isArchived;
    }

    public function setIsArchived(bool $isArchived): self
    {
        $this->isArchived = $isArchived;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        // unset the owning side of the relation if necessary
        if ($image === null && $this->image !== null) {
            $this->image->setProduit(null);
        }

        // set the owning side of the relation if necessary
        if ($image !== null && $image->getProduit() !== $this) {
            $image->setProduit($this);
        }

        $this->image = $image;

        return $this;
    }
}
