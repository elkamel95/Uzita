<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HotelRepository")
 */
class Hotel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $etoile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

   

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sejour", inversedBy="hotels")
     */
    private $sejour;
 /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $topHotel;
    

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Article", inversedBy="hotel", cascade={"persist", "remove"})
     */
    private $aticle;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtoile(): ?int
    {
        return $this->etoile;
    }

    public function setEtoile(int $etoile): self
    {
        $this->etoile = $etoile;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

   

    public function getSejour(): ?Sejour
    {
        return $this->sejour;
    }

    public function setSejour(?Sejour $sejour): self
    {
        $this->sejour = $sejour;

        return $this;
    }

    public function getTopHotel(): ?bool
    {
        return $this->topHotel;
    }

    public function setTopHotel(?bool  $topHotel): self
    {
        $this->topHotel = $topHotel;

        return $this;
    }

    public function getAticle(): ?Article
    {
        return $this->aticle;
    }

    public function setAticle(?Article $aticle): self
    {
        $this->aticle = $aticle;

        return $this;
    }


}
