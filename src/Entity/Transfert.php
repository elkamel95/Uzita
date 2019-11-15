<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransfertRepository")
 */
class Transfert
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
    private $duree;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kilometre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prixcomprend;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getKilometre(): ?string
    {
        return $this->kilometre;
    }

    public function setKilometre(string $kilometre): self
    {
        $this->kilometre = $kilometre;

        return $this;
    }

    public function getPrixcomprend(): ?string
    {
        return $this->prixcomprend;
    }

    public function setPrixcomprend(string $prixcomprend): self
    {
        $this->prixcomprend = $prixcomprend;

        return $this;
    }
}
