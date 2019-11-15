<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $pix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $shortdesc;

    /**
     * @ORM\Column(type="text", length= 600000)
     */
    private $descrip;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dest;

    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $datedep;

    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $datearriv;

    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $datecreat;

    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $datemodif;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="Article",cascade={"persist", "remove"})
     */
    private $reservations;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Promos", inversedBy="articles")
     */
    private $promo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $topDistination;

 

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Hotel", mappedBy="aticle", cascade={"persist", "remove"})
     */
    private $hotel;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Media", cascade={"persist", "remove"})
     */
    private $Media;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Images", mappedBy="article", cascade={"persist", "remove"})
     */
    private $images;

 /**
     * @ORM\OneToOne(targetEntity="App\Entity\Voyage",mappedBy="Article", cascade={"persist", "remove"})
     */
    private $voyage;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vol", mappedBy="article", cascade={"persist", "remove"})
     */
    private $vol;

  






 /**
 * @param ArrayCollection|SubStatusOptions[]
 */
public function setSubStatusOptions(ArrayCollection $subStatusOptions)
{
    $this->subStatusOptions = $subStatusOptions;
}


    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPix(): ?float
    {
        return $this->pix;
    }

    public function setPix(?float $pix): self
    {
        $this->pix = $pix;

        return $this;
    }

    public function getShortdesc(): ?string
    {
        return $this->shortdesc;
    }

    public function setShortdesc(string $shortdesc): self
    {
        $this->shortdesc = $shortdesc;

        return $this;
    }

    public function getDescrip(): ?string
    {
        return $this->descrip;
    }

    public function setDescrip(string $descrip): self
    {
        $this->descrip = $descrip;

        return $this;
    }

    public function getDest(): ?string
    {
        return $this->dest;
    }

    public function setDest(string $dest): self
    {
        $this->dest = $dest;

        return $this;
    }

    public function getDatedep(): ?\DateTimeInterface
    {
        return $this->datedep;
    }

    public function setDatedep(\DateTimeInterface $datedep): self
    {
        $this->datedep = $datedep;

        return $this;
    }

    public function getDatearriv(): ?\DateTimeInterface
    {
        return $this->datearriv;
    }

    public function setDatearriv(\DateTimeInterface $datearriv): self
    {
        $this->datearriv = $datearriv;

        return $this;
    }

    public function getDatecreat(): ?\DateTimeInterface
    {
        return $this->datecreat;
    }

    public function setDatecreat(\DateTimeInterface $datecreat): self
    {
        $this->datecreat = $datecreat;

        return $this;
    }

    public function getDatemodif(): ?\DateTimeInterface
    {
        return $this->datemodif;
    }

    public function setDatemodif(\DateTimeInterface $datemodif): self
    {
        $this->datemodif = $datemodif;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setArticle($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getArticle() === $this) {
                $reservation->setArticle(null);
            }
        }

        return $this;
    }

    public function getPromo(): ?Promos
    {
        return $this->promo;
    }

    public function setPromo(?Promos $promo): self
    {
        $this->promo = $promo;

        return $this;
    }

    public function getTopDistination(): ?bool
    {
        return $this->topDistination;
    }

    public function setTopDistination(?bool $topDistination): self
    {
        $this->topDistination = $topDistination;

        return $this;
    }


    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        // set (or unset) the owning side of the relation if necessary
        $newAticle = $hotel === null ? null : $this;
        if ($newAticle !== $hotel->getAticle()) {
            $hotel->setAticle($newAticle);
        }

        return $this;
    }

    public function getMedia(): ?Media
    {
        return $this->Media;
    }

    public function setMedia(?Media $Media): self
    {
        $this->Media = $Media;

        return $this;
    }

   
    /**
     * @return Collection|Reservation[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function setImages(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setArticle($this);
        }

        return $this;
    }

  

     

   


    public function getVoyage(): ?Voyage
    {
        return $this->voyage;
    }

    public function setVoyage(?Voyage $voyage): self
    {
        $this->voyage = $voyage;

        // set (or unset) the owning side of the relation if necessary
        $newAticle = $voyage === null ? null : $this;
        if ($newAticle !== $voyage->getArticle()) {
            $voyage->setArticle($newAticle);
        }

        return $this;
    }

    public function getVol(): ?Vol
    {
        return $this->vol;
    }

    public function setVol(?Vol $vol): self
    {
        $this->vol = $vol;

        // set (or unset) the owning side of the relation if necessary
        $newArticle = $vol === null ? null : $this;
        if ($newArticle !== $vol->getArticle()) {
            $vol->setArticle($newArticle);
        }

        return $this;
    }

  




  



   


}
