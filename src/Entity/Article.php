<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticleRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use symfony\componenent\httpFoundation\File\UploadFile;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 * @vich\Uploadable
 */
class Article
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
    private $nom;

 

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="articles")
     */
    private $categorie;


    /**
     * @ORM\Column (type="string",length=255,nullable=true)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="article",fileNameProperty="image")
     * @var File
     */
        private $imageFile;


    /**
     * @ORM\Column (type="string",length=255,nullable=true)
     */
    private $file;

    /**
     * @Vich\UploadableField(mapping="article",fileNameProperty="file")
     * @var File
     */
        private $fichierFile;

        /**
         * @ORM\ManyToOne(targetEntity=User::class, inversedBy="articles")
         */
        private $user;

        /**
         * @Gedmo\Timestampable(on="create")
         * @ORM\Column(type="datetime_immutable")
         */
        private $createdAt;

        /**
         * @Gedmo\Timestampable(on="update")
         * @ORM\Column(type="datetime_immutable")
         */
        private $updatedAt;

        /**
         * @ORM\Column(type="integer", nullable=true)
         */
        private $View;

        /**
         * @ORM\Column(type="string", length=255, nullable=true)
         */
        private $youtube;

        /**
         * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="article", orphanRemoval=true)
         */
        private $comments;

        /**
         * @ORM\Column(type="integer", nullable=true)
         */
        private $favorit;

        public function __construct()
        {
            $this->comments = new ArrayCollection();
        }


        public function getAvgRating(){

            $sum = array_reduce($this->comments->toArray(),function($total,$comment){
                return $total +$comment->getRating();

            },0);

            if(count($this->comments) > 0) return $moyenne=$sum / count($this->comments);

            return 0;
        }
    

    public function __toString(): string
    {
        return $this->id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }


    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

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

    
    /**
 * @return string|null
 */
public function getFile(): ?string
{
    return $this->file;
}

/**
 * @param string|null $image
 * @return $this
 */
    public function setFile(?string $file):self
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getfichierFile(): ?File 
    {
        return $this->fichierFile;
    }


    /**
     * @param File|null $imageFile
     */

    public function setfichierFile(?File $fichierFile=null)
    {
        $this->fichierFile = $fichierFile;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

 

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getView(): ?int
    {
        return $this->View;
    }

    public function setView(?int $View): self
    {
        $this->View = $View;

        return $this;
    }

    public function getYoutube(): ?string
    {
        return $this->youtube;
    }

    public function setYoutube(?string $youtube): self
    {
        $this->youtube = $youtube;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setArticle($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getArticle() === $this) {
                $comment->setArticle(null);
            }
        }

        return $this;
    }

    public function getFavorit(): ?int
    {
        return $this->favorit;
    }

    public function setFavorit(?int $favorit): self
    {
        $this->favorit = $favorit;

        return $this;
    }





 

}
