<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RtillRepository")
 */
class Rtill
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
    private $jjh;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJjh(): ?string
    {
        return $this->jjh;
    }

    public function setJjh(string $jjh): self
    {
        $this->jjh = $jjh;

        return $this;
    }
}
