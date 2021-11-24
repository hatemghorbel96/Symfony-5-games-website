<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use symfony\componenent\httpFoundation\File\UploadFile;
/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

      /**
     * @ORM\Column (type="string",length=255,nullable=true)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="article",fileNameProperty="image")
     * @var File
     */
        private $imageFile;

    public function getId(): ?int
    {
        return $this->id;
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
 * @return string|null
 */
public function getImage(): ?string
{
    return $this->image;
}

/**
 * @param string|null $image
 * @return $this
 */
public function setImage(?string $image):self
{
    $this->image = $image;
    return $this;
}

/**
 * @return File|null
 */
public function getImageFile(): ?File 
{
    return $this->imageFile;
}

/**
 * @param File|null $imageFile
 */

public function setImageFile(?File $imageFile=null)
{
    $this->imageFile = $imageFile;
}

}
