<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Images
{
      /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

   

   

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="images" )
     */
    private $article;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $alt;

  

   

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl( $url)
    {
        $this->url = $url;

        return $this;
    }

    public function getAlt()
    {
        return $this->alt;
    }

    public function setAlt( $alt)
    {
        $this->alt = $alt;

        return $this;
    }




    

   

   

}