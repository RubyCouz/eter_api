<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Scalar\String_;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EterGameRepository")
 * @Vich\Uploadable
 * @ApiResource()
 */
class EterGame
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
    private $game_name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\EterUser", mappedBy="user_game")
     */
    private $eterUsers;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\EterGender", inversedBy="eterGames")
     */
    private $game_gender;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $game_pic;

    /**
     * @Vich\UploadableField(mapping="game", fileNameProperty="game_pic")
     * @var File
     */
    private $pic;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $game_description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $game_background;

    /**
     * @Vich\UploadableField (mapping="game_background", fileNameProperty="game_background")
     * @var File
     */
    private $background;

    public function __construct()
    {
        $this->eterUsers = new ArrayCollection();
        $this->game_gender = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameName(): ?string
    {
        return $this->game_name;
    }

    public function setGameName(string $game_name): self
    {
        $this->game_name = $game_name;

        return $this;
    }

    public function __toString()
    {
        return $this->game_name;
    }
    /**
     * @return Collection|EterUser[]
     */
    public function getEterUsers(): Collection
    {
        return $this->eterUsers;
    }

    public function addEterUser(EterUser $eterUser): self
    {
        if (!$this->eterUsers->contains($eterUser)) {
            $this->eterUsers[] = $eterUser;
            $eterUser->addUserGame($this);
        }

        return $this;
    }

    public function removeEterUser(EterUser $eterUser): self
    {
        if ($this->eterUsers->contains($eterUser)) {
            $this->eterUsers->removeElement($eterUser);
            $eterUser->removeUserGame($this);
        }

        return $this;
    }

    /**
     * @return Collection|EterGender[]
     */
    public function getGameGender(): Collection
    {
        return $this->game_gender;
    }

    public function addGameGender(EterGender $gameGender): self
    {
        if (!$this->game_gender->contains($gameGender)) {
            $this->game_gender[] = $gameGender;
        }

        return $this;
    }

    public function removeGameGender(EterGender $gameGender): self
    {
        if ($this->game_gender->contains($gameGender)) {
            $this->game_gender->removeElement($gameGender);
        }

        return $this;
    }

    public function getGamePic(): ?string
    {
        return $this->game_pic;
    }

    public function setGamePic(?string $game_pic): self
    {
      $this->game_pic = $game_pic;
        return $this;
    }

    public function setPic(File $game_pic = null)
    {
        $this->pic = $game_pic;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($game_pic) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getPic()
    {
        return $this->pic;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getGameDescription(): ?string
    {
        return $this->game_description;
    }

    public function setGameDescription(?string $game_description): self
    {
        $this->game_description = $game_description;

        return $this;
    }

    public function getGameBackground(): ?string
    {
        return $this->game_background;
    }

    public function setGameBackground(?string $game_background): self
    {
        $this->game_background = $game_background;

        return $this;
    }
    public function setBackground(File $game_background = null)
    {
        $this->pic = $game_background;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($game_background) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getBackground()
    {
        return $this->pic;
    }
}
