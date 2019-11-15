<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CircuitRepository")
 */
class Circuit
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
    private $prixIncluant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prixNincusPas;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixIncluant(): ?string
    {
        return $this->prixIncluant;
    }

    public function setPrixIncluant(string $prixIncluant): self
    {
        $this->prixIncluant = $prixIncluant;

        return $this;
    }

    public function getPrixNincusPas(): ?string
    {
        return $this->prixNincusPas;
    }

    public function setPrixNincusPas(string $prixNincusPas): self
    {
        $this->prixNincusPas = $prixNincusPas;

        return $this;
    }
}
