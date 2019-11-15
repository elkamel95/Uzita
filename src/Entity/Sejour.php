<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SejourRepository")
 */
class Sejour
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $paye;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hotel", mappedBy="sejour")
     */
    private $hotels;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ville", mappedBy="sejour")
     */
    private $villes;


    public function __construct()
    {
        $this->hotels = new ArrayCollection();
        $this->villes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaye(): ?string
    {
        return $this->paye;
    }

    public function setPaye(string $paye): self
    {
        $this->paye = $paye;

        return $this;
    }

  

    /**
     * @return Collection|Hotel[]
     */
    public function getHotels(): Collection
    {
        return $this->hotels;
    }

    public function addHotel(Hotel $hotel): self
    {
        if (!$this->hotels->contains($hotel)) {
            $this->hotels[] = $hotel;
            $hotel->setSejour($this);
        }

        return $this;
    }

    public function removeHotel(Hotel $hotel): self
    {
        if ($this->hotels->contains($hotel)) {
            $this->hotels->removeElement($hotel);
            // set the owning side to null (unless already changed)
            if ($hotel->getSejour() === $this) {
                $hotel->setSejour(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ville[]
     */
    public function getVilles(): Collection
    {
        return $this->villes;
    }

    public function addVille(Ville $ville): self
    {
        if (!$this->villes->contains($ville)) {
            $this->villes[] = $ville;
            $ville->setSejour($this);
        }

        return $this;
    }

    public function removeVille(Ville $ville): self
    {
        if ($this->villes->contains($ville)) {
            $this->villes->removeElement($ville);
            // set the owning side to null (unless already changed)
            if ($ville->getSejour() === $this) {
                $ville->setSejour(null);
            }
        }

        return $this;
    }


}
