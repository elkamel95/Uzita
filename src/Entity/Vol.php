<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VolRepository")
 */
class Vol
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
    private $class;

    /**
     * @ORM\Column(type="integer")
     */
    private $adulte;

    /**
     * @ORM\Column(type="integer")
     */
    private $jeune;

   

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Article", inversedBy="vol", cascade={"persist", "remove"})
     */
    private $article;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $TypeVol;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $depart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $time;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $timeDarriver;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getAdulte(): ?int
    {
        return $this->adulte;
    }

    public function setAdulte(int $adulte): self
    {
        $this->adulte = $adulte;

        return $this;
    }

    public function getJeune(): ?int
    {
        return $this->jeune;
    }

    public function setJeune(int $jeune): self
    {
        $this->jeune = $jeune;

        return $this;
    }



    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getTypeVol(): ?string
    {
        return $this->TypeVol;
    }

    public function setTypeVol(string $TypeVol): self
    {
        $this->TypeVol = $TypeVol;

        return $this;
    }

    public function getDepart(): ?string
    {
        return $this->depart;
    }

    public function setDepart(string $depart): self
    {
        $this->depart = $depart;

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(string $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getTimeDarriver(): ?string
    {
        return $this->timeDarriver;
    }

    public function setTimeDarriver(string $timeDarriver): self
    {
        $this->timeDarriver = $timeDarriver;

        return $this;
    }
}
