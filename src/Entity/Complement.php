<?php

namespace App\Entity;

use App\Repository\ComplementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
#[InheritanceType("JOINED")]
#[DiscriminatorColumn("type")]
#[DiscriminatorMap([
   "boisson"=>"Boisson",
   "frite"=>"Frite"
])]

#[ORM\Entity(repositoryClass: ComplementRepository::class)]
abstract class Complement extends Produit
{
   

    #[ORM\Column]
    protected ?float $prix = null;

    #[ORM\OneToMany(mappedBy: 'complement', targetEntity: Image::class)]
    protected Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

   

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setComplement($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getComplement() === $this) {
                $image->setComplement(null);
            }
        }

        return $this;
    }
}
