<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EterGenderRepository")
 * @ApiResource()
 */
class EterGender
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
    private $gender_name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\EterGame", mappedBy="game_gender")
     */
    private $eterGames;

    public function __construct()
    {
        $this->eterGames = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenderName(): ?string
    {
        return $this->gender_name;
    }

    public function setGenderName(string $gender_name): self
    {
        $this->gender_name = $gender_name;

        return $this;
    }

    public function __toString()
    {
        return $this->gender_name;
    }

    /**
     * @return Collection|EterGame[]
     */
    public function getEterGames(): Collection
    {
        return $this->eterGames;
    }

    public function addEterGame(EterGame $eterGame): self
    {
        if (!$this->eterGames->contains($eterGame)) {
            $this->eterGames[] = $eterGame;
            $eterGame->addGameGender($this);
        }

        return $this;
    }

    public function removeEterGame(EterGame $eterGame): self
    {
        if ($this->eterGames->contains($eterGame)) {
            $this->eterGames->removeElement($eterGame);
            $eterGame->removeGameGender($this);
        }

        return $this;
    }
}
