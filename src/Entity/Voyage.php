<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoyageRepository")
 */
class Voyage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Jour", mappedBy="voyage", cascade={"persist", "remove"})
     */
    private $joure;

   

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Article", inversedBy="voyage", cascade={"persist", "remove"})
     */
    private $Article;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sejour")
     */
    private $sejour;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Circuit", cascade={"persist", "remove"})
     */
    private $circuit;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Transfert", cascade={"persist", "remove"})
     */
    private $transfert;


    public function __construct()
    {
        $this->joure = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|jour[]
     */
    public function getJoure(): Collection
    {
        return $this->joure;
    }

    public function addJoure(jour $joure): self
    {
        if (!$this->joure->contains($joure)) {
            $this->joure[] = $joure;
            $joure->setVoyage($this);
        }

        return $this;
    }

    public function removeJoure(jour $joure): self
    {
        if ($this->joure->contains($joure)) {
            $this->joure->removeElement($joure);
            // set the owning side to null (unless already changed)
            if ($joure->getVoyage() === $this) {
                $joure->setVoyage(null);
            }
        }

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->Article;
    }

    public function setArticle(?Article $Article): self
    {
        $this->Article = $Article;

        return $this;
    }

    public function getSejour(): ?sejour
    {
        return $this->sejour;
    }

    public function setSejour(?sejour $sejour): self
    {
        $this->sejour = $sejour;

        return $this;
    }

    public function getCircuit(): ?circuit
    {
        return $this->circuit;
    }

    public function setCircuit(?circuit $circuit): self
    {
        $this->circuit = $circuit;

        return $this;
    }

    public function getTransfert(): ?transfert
    {
        return $this->transfert;
    }

    public function setTransfert(?transfert $transfert): self
    {
        $this->transfert = $transfert;

        return $this;
    }


}
