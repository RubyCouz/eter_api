<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EterEventRepository")
 * @ApiResource()
 */
class EterEvent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $event_date;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $event_score;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $event_winner;

    /**
     * @ORM\Column(type="datetime")
     */
    private $event_creation;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\EterUser", inversedBy="eterEvents")
     */
    private $event_orga;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\EterClan", mappedBy="clan_event")
     */
    private $eterClans;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $event_name;

    public function __construct()
    {

        $this->event_orga = new ArrayCollection();
        $this->eterClans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventDate(): ?\DateTimeInterface
    {
        return $this->event_date;
    }

    public function setEventDate(\DateTimeInterface $event_date): self
    {
        $this->event_date = $event_date;

        return $this;
    }

    public function getEventScore(): ?string
    {
        return $this->event_score;
    }

    public function setEventScore(?string $event_score): self
    {
        $this->event_score = $event_score;

        return $this;
    }

    public function getEventWinner(): ?string
    {
        return $this->event_winner;
    }

    public function setEventWinner(?string $event_winner): self
    {
        $this->event_winner = $event_winner;

        return $this;
    }

    public function getEventCreation(): ?\DateTimeInterface
    {
        return $this->event_creation;
    }

    public function setEventCreation(\DateTimeInterface $event_creation): self
    {
        $this->event_creation = $event_creation;

        return $this;
    }


    /**
     * @return Collection|EterUser[]
     */
    public function getEventOrga(): Collection
    {
        return $this->event_orga;
    }

    public function addEventOrga(EterUser $eventOrga): self
    {
        if (!$this->event_orga->contains($eventOrga)) {
            $this->event_orga[] = $eventOrga;
        }

        return $this;
    }

    public function removeEventOrga(EterUser $eventOrga): self
    {
        if ($this->event_orga->contains($eventOrga)) {
            $this->event_orga->removeElement($eventOrga);
        }

        return $this;
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
            $eterClan->addClanEvent($this);
        }

        return $this;
    }

    public function removeEterClan(EterClan $eterClan): self
    {
        if ($this->eterClans->contains($eterClan)) {
            $this->eterClans->removeElement($eterClan);
            $eterClan->removeClanEvent($this);
        }

        return $this;
    }

    public function getEventName(): ?string
    {
        return $this->event_name;
    }

    public function setEventName(string $event_name): self
    {
        $this->event_name = $event_name;

        return $this;
    }


    public function __toString()
    {
        return $this->event_name;
    }
}
