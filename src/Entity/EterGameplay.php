<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EterGameplayRepository")
 * @ApiResource()
 */
class EterGameplay
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $gameplay_type;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\EterClan", mappedBy="clan_gameplay")
     */
    private $eterClans;

    public function __construct()
    {
        $this->eterClans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameplayType(): ?string
    {
        return $this->gameplay_type;
    }

    public function setGameplayType(string $gameplay_type): self
    {
        $this->gameplay_type = $gameplay_type;

        return $this;
    }

    public function __toString()
    {
        return $this->gameplay_type;
    }
    /**
     * @return Collection|EterClan[]
     */
    public function getEterClans(): Collection
    {
        return $this->eterClans;
    }

    public function addEterClan(EterClan $eterClan): self
    {
        if (!$this->eterClans->contains($eterClan)) {
            $this->eterClans[] = $eterClan;
            $eterClan->addClanGameplay($this);
        }

        return $this;
    }

    public function removeEterClan(EterClan $eterClan): self
    {
        if ($this->eterClans->contains($eterClan)) {
            $this->eterClans->removeElement($eterClan);
            $eterClan->removeClanGameplay($this);
        }

        return $this;
    }
}
