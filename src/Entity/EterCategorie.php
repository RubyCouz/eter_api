<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EterCategorieRepository")
 * @ApiResource()
 */
class EterCategorie
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
    private $cat_name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EterContent", mappedBy="content_cat")
     */
    private $eterContents;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EterCategorie", inversedBy="cat_parent")
     */
    private $eterCategorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EterCategorie", mappedBy="eterCategorie")
     */
    private $cat_parent;

    public function __construct()
    {
        $this->eterContents = new ArrayCollection();
        $this->cat_parent = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatName(): ?string
    {
        return $this->cat_name;
    }

    public function setCatName(string $cat_name): self
    {
        $this->cat_name = $cat_name;

        return $this;
    }

    /**
     * @return Collection|EterContent[]
     */
    public function getEterContents(): Collection
    {
        return $this->eterContents;
    }

    public function addEterContent(EterContent $eterContent): self
    {
        if (!$this->eterContents->contains($eterContent)) {
            $this->eterContents[] = $eterContent;
            $eterContent->setContentCat($this);
        }

        return $this;
    }

    public function removeEterContent(EterContent $eterContent): self
    {
        if ($this->eterContents->contains($eterContent)) {
            $this->eterContents->removeElement($eterContent);
            // set the owning side to null (unless already changed)
            if ($eterContent->getContentCat() === $this) {
                $eterContent->setContentCat(null);
            }
        }

        return $this;
    }

    public function getEterCategorie(): ?self
    {
        return $this->eterCategorie;
    }

    public function setEterCategorie(?self $eterCategorie): self
    {
        $this->eterCategorie = $eterCategorie;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getCatParent(): Collection
    {
        return $this->cat_parent;
    }

    public function addCatParent(self $catParent): self
    {
        if (!$this->cat_parent->contains($catParent)) {
            $this->cat_parent[] = $catParent;
            $catParent->setEterCategorie($this);
        }

        return $this;
    }

    public function removeCatParent(self $catParent): self
    {
        if ($this->cat_parent->contains($catParent)) {
            $this->cat_parent->removeElement($catParent);
            // set the owning side to null (unless already changed)
            if ($catParent->getEterCategorie() === $this) {
                $catParent->setEterCategorie(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        return $this->cat_name;
    }
}
