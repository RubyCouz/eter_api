<?php

namespace App\Entity;

use App\Repository\EterProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EterProductRepository::class)
 */
class EterProduct
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $product_title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $product_image;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $product_price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $product_quantity;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $product_description;

    /**
     * @ORM\ManyToMany(targetEntity=EterUser::class, inversedBy="eterProducts")
     */
    private $eter_user;

    public function __construct()
    {
        $this->eter_user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductTitle(): ?string
    {
        return $this->product_title;
    }

    public function setProductTitle(string $product_title): self
    {
        $this->product_title = $product_title;

        return $this;
    }

    public function getProductImage(): ?string
    {
        return $this->product_image;
    }

    public function setProductImage(?string $product_image): self
    {
        $this->product_image = $product_image;

        return $this;
    }

    public function getProductPrice(): ?float
    {
        return $this->product_price;
    }

    public function setProductPrice(int $product_price): self
    {
        $this->product_price = $product_price;

        return $this;
    }

    public function getProductQuantity(): ?int
    {
        return $this->product_quantity;
    }

    public function setProductQuantity(?int $product_quantity): self
    {
        $this->product_quantity = $product_quantity;

        return $this;
    }

    public function getProductDescription(): ?string
    {
        return $this->product_description;
    }

    public function setProductDescription(?string $product_description): self
    {
        $this->product_description = $product_description;

        return $this;
    }

    /**
     * @return Collection|EterUser[]
     */
    public function getEterUser(): Collection
    {
        return $this->eter_user;
    }

    public function addEterUser(EterUser $eterUser): self
    {
        if (!$this->eter_user->contains($eterUser)) {
            $this->eter_user[] = $eterUser;
        }

        return $this;
    }

    public function removeEterUser(EterUser $eterUser): self
    {
        if ($this->eter_user->contains($eterUser)) {
            $this->eter_user->removeElement($eterUser);
        }

        return $this;
    }

}
