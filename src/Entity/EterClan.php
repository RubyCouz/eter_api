<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints\DateTime;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EterClanRepository")
 * @Vich\Uploadable
 * @ApiResource()
 */
class EterClan
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $clan_name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $clan_members;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $clan_desc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $clan_ban;

    /**
     * @Vich\UploadableField(mapping="clan_ban", fileNameProperty="clan_ban")
     * @var File
     */
    private $ban_pic;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $clan_discord;

    /**
     * @ORM\Column(type="boolean")
     */
    private $clan_recrut;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\EterGameplay", inversedBy="eterClans")
     */
    private $clan_gameplay;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\EterUser", mappedBy="user_clan")
     */
    private $eterUsers;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\EterEvent", inversedBy="eterClans")
     */
    private $clan_event;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $clan_slogan;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $clan_update;



    public function __construct()
    {
        $this->clan_gameplay = new ArrayCollection();
        $this->eterUsers = new ArrayCollection();
        $this->clan_event = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClanName(): ?string
    {
        return $this->clan_name;
    }

    public function setClanName(string $clan_name): self
    {
        $this->clan_name = $clan_name;

        return $this;
    }

    public function __toString()
    {
        return $this->clan_name;
    }

    public function getClanMembers(): ?int
    {
        return $this->clan_members;
    }

    public function setClanMembers(int $clan_members): self
    {
        $this->clan_members = $clan_members;

        return $this;
    }

    public function getClanDesc(): ?string
    {
        return $this->clan_desc;
    }

    public function setClanDesc(string $clan_desc): self
    {
        $this->clan_desc = $clan_desc;

        return $this;
    }

    public function getClanBan(): ?string
    {
        return $this->clan_ban;
    }

    public function setClanBan(?string $clan_ban): self
    {
        $this->clan_ban = $clan_ban;

        return $this;
    }

    public function getClanDiscord(): ?string
    {
        return $this->clan_discord;
    }

    public function setClanDiscord(?string $clan_discord): self
    {
        $this->clan_discord = $clan_discord;

        return $this;
    }

    public function getClanRecrut(): ?bool
    {
        return $this->clan_recrut;
    }

    public function setClanRecrut(bool $clan_recrut): self
    {
        $this->clan_recrut = $clan_recrut;

        return $this;
    }


    /**
     * @return Collection|EterGameplay[]
     */
    public function getClanGameplay(): Collection
    {
        return $this->clan_gameplay;
    }

    public function addClanGameplay(EterGameplay $clanGameplay): self
    {
        if (!$this->clan_gameplay->contains($clanGameplay)) {
            $this->clan_gameplay[] = $clanGameplay;
        }

        return $this;
    }

    public function removeClanGameplay(EterGameplay $clanGameplay): self
    {
        if ($this->clan_gameplay->contains($clanGameplay)) {
            $this->clan_gameplay->removeElement($clanGameplay);
        }

        return $this;
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
            $eterUser->addUserClan($this);
        }

        return $this;
    }

    public function removeEterUser(EterUser $eterUser): self
    {
        if ($this->eterUsers->contains($eterUser)) {
            $this->eterUsers->removeElement($eterUser);
            $eterUser->removeUserClan($this);
        }

        return $this;
    }

    /**
     * @return Collection|EterEvent[]
     */
    public function getClanEvent(): Collection
    {
        return $this->clan_event;
    }

    public function addClanEvent(EterEvent $clanEvent): self
    {
        if (!$this->clan_event->contains($clanEvent)) {
            $this->clan_event[] = $clanEvent;
        }

        return $this;
    }

    public function removeClanEvent(EterEvent $clanEvent): self
    {
        if ($this->clan_event->contains($clanEvent)) {
            $this->clan_event->removeElement($clanEvent);
        }

        return $this;
    }

    public function getClanSlogan(): ?string
    {
        return $this->clan_slogan;
    }

    public function setClanSlogan(?string $clan_slogan): self
    {
        $this->clan_slogan = $clan_slogan;

        return $this;
    }

    public function setBanPic(File $clan_ban = null) {
        $this->ban_pic = $clan_ban;
        // ajout d'un champs modif datetime dans la bdd pour forcer la persistance
        if ($clan_ban) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->clan_update = new \DateTime('now');
        }
    }

    public function getBanPic() {
        return $this->ban_pic;
    }

    public function getClanUpdate(): ?\DateTimeInterface
    {
        return $this->clan_update;
    }

    public function setClanUpdate(\DateTimeInterface $clan_update): self
    {
        $this->clan_update = $clan_update;

        return $this;
    }

}
