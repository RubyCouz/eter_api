<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EterUserRepository")
 * @Vich\Uploadable
 * @UniqueEntity(
 * fields = {"user_mail"}, 
 * message = "L'email existe déjà")
 * @ApiResource()
 */
class EterUser implements UserInterface
{
    // définition d'un tableau des rôles => constante
    const ROLE = [
        0 => 'Administrateur',
        1 => 'Utilisateur'
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $user_login;

    /**
     * @ORM\Column(type="datetime")
     */
    private $user_date;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $user_mail;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $user_password;

    /**
    * @Assert\EqualTo(propertyPath="user_password", message="Vos mots de passe sont différents")
    */
    public $confirm_user_password;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $user_address;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $user_zip;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $user_city;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $user_discord;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $user_sex;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $statut;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\EterLabel", inversedBy="eterUsers")
     */
    private $label;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\EterClan", inversedBy="eterUsers")
     */
    private $user_clan;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\EterGame", inversedBy="eterUsers", cascade={"persist"})
     */
    private $user_game;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EterStreamer", mappedBy="eterUser")
     */
    private $user_stream;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\EterEvent", mappedBy="event_orga")
     */
    private $eterEvents;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EterComment", mappedBy="com_user")
     */
    private $eterComments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EterContent", mappedBy="content_user")
     */
    private $eterContents;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $user_description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $user_update;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $user_avatar;

    /**
     * @Vich\UploadableField(mapping="profil_pic", fileNameProperty="user_avatar")
     * @var File
     */
    private $user_pic;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user_role;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $activation_token;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $reset_token;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $date_inscr;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $date_lien;

    /**
     * @ORM\ManyToMany(targetEntity=EterProduct::class, mappedBy="eter_user")
     */
    private $eterProducts;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $user_order_date;

    /**
     * @ORM\Column(type="boolean")
     */
    private $user_desactivate;

    public function __construct()
    {
        $this->user_date = new \DateTime('Europe/Paris');
        $this->role = new ArrayCollection();
        $this->user_clan = new ArrayCollection();
        $this->user_game = new ArrayCollection();
        $this->user_stream = new ArrayCollection();
        $this->eterEvents = new ArrayCollection();
        $this->eterComments = new ArrayCollection();
        $this->eterContents = new ArrayCollection();
        $this->eterProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserLogin(): ?string
    {
        return $this->user_login;
    }

    public function setUserLogin(string $user_login): self
    {
        $this->user_login = $user_login;

        return $this;
    }

    public function __toString()
    {
        return $this->user_login;
    }

    public function getUserDate(): ?\DateTimeInterface
    {
        return $this->user_date;
    }

    public function setUserDate(\DateTimeInterface $user_date): self
    {
        $this->user_date = $user_date;

        return $this;
    }

    public function getUserMail(): ?string
    {
        return $this->user_mail;
    }

    public function setUserMail(string $user_mail): self
    {
        $this->user_mail = $user_mail;

        return $this;
    }

    public function getUserPassword(): ?string
    {
        return $this->user_password;
    }

    public function setUserPassword(string $user_password): self
    {
        $this->user_password = $user_password;

        return $this;
    }

    public function getUserAddress(): ?string
    {
        return $this->user_address;
    }

    public function setUserAddress(?string $user_address): self
    {
        $this->user_address = $user_address;

        return $this;
    }

    public function getUserZip(): ?string
    {
        return $this->user_zip;
    }

    public function setUserZip(?string $user_zip): self
    {
        $this->user_zip = $user_zip;

        return $this;
    }

    public function getUserCity(): ?string
    {
        return $this->user_city;
    }

    public function setUserCity(?string $user_city): self
    {
        $this->user_city = $user_city;

        return $this;
    }

    public function getUserDiscord(): ?string
    {
        return $this->user_discord;
    }

    public function setUserDiscord(string $user_discord): self
    {
        $this->user_discord = $user_discord;

        return $this;
    }

    public function getUserSex(): ?string
    {
        return $this->user_sex;
    }

    public function setUserSex(?string $user_sex): self
    {
        $this->user_sex = $user_sex;

        return $this;
    }

    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(?bool $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getUserRole(): ?string
    {
        return $this->user_role;
    }

    public function setUserRole(?string $user_role): self
    {
        // role automatique par défaut
        $user_role = 'Utilisateur';
        $this->user_role = $user_role;

        return $this;
    }

    /**
     * @return Collection|EterLabel[]
     */
    public function getLabel(): Collection
    {
        return $this->label;
    }

    public function addLabel(EterLabel $label): self
    {
        if (!$this->label->contains($label)) {
            $this->label[] = $label;
        }

        return $this;
    }

    public function removeUserLabel(EterLabel $userLabel): self
    {
        if ($this->label->contains($userLabel)) {
            $this->label->removeElement($userLabel);
        }

        return $this;
    }

    /**
     * @return Collection|EterClan[]
     */
    public function getUserClan(): Collection
    {
        return $this->user_clan;
    }

    public function addUserClan(EterClan $userClan): self
    {
        if (!$this->user_clan->contains($userClan)) {
            $this->user_clan[] = $userClan;
        }

        return $this;
    }

    public function removeUserClan(EterClan $userClan): self
    {
        if ($this->user_clan->contains($userClan)) {
            $this->user_clan->removeElement($userClan);
        }

        return $this;
    }

    /**
     * @return Collection|EterGame[]
     */
    public function getUserGame(): Collection
    {
        return $this->user_game;
    }

    public function addUserGame(EterGame $userGame): self
    {
        if (!$this->user_game->contains($userGame)) {
            $this->user_game[] = $userGame;
        }

        return $this;
    }

    public function removeUserGame(EterGame $userGame): self
    {
        if ($this->user_game->contains($userGame)) {
            $this->user_game->removeElement($userGame);
        }

        return $this;
    }

    /**
     * @return Collection|EterStreamer[]
     */
    public function getUserStream(): Collection
    {
        return $this->user_stream;
    }

    public function addUserStream(EterStreamer $userStream): self
    {
        if (!$this->user_stream->contains($userStream)) {
            $this->user_stream[] = $userStream;
            $userStream->setEterUser($this);
        }

        return $this;
    }

    public function removeUserStream(EterStreamer $userStream): self
    {
        if ($this->user_stream->contains($userStream)) {
            $this->user_stream->removeElement($userStream);
            // set the owning side to null (unless already changed)
            if ($userStream->getEterUser() === $this) {
                $userStream->setEterUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|EterEvent[]
     */
    public function getEterEvents(): Collection
    {
        return $this->eterEvents;
    }

    public function addEterEvent(EterEvent $eterEvent): self
    {
        if (!$this->eterEvents->contains($eterEvent)) {
            $this->eterEvents[] = $eterEvent;
            $eterEvent->addEventInit($this);
        }

        return $this;
    }

    public function removeEterEvent(EterEvent $eterEvent): self
    {
        if ($this->eterEvents->contains($eterEvent)) {
            $this->eterEvents->removeElement($eterEvent);
            $eterEvent->removeEventInit($this);
        }

        return $this;
    }

    /**
     * @return Collection|EterComment[]
     */
    public function getEterComments(): Collection
    {
        return $this->eterComments;
    }

    public function addEterComment(EterComment $eterComment): self
    {
        if (!$this->eterComments->contains($eterComment)) {
            $this->eterComments[] = $eterComment;
            $eterComment->setComUser($this);
        }

        return $this;
    }

    public function removeEterComment(EterComment $eterComment): self
    {
        if ($this->eterComments->contains($eterComment)) {
            $this->eterComments->removeElement($eterComment);
            // set the owning side to null (unless already changed)
            if ($eterComment->getComUser() === $this) {
                $eterComment->setComUser(null);
            }
        }

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
            $eterContent->setContentUser($this);
        }

        return $this;
    }

    public function removeEterContent(EterContent $eterContent): self
    {
        if ($this->eterContents->contains($eterContent)) {
            $this->eterContents->removeElement($eterContent);
            // set the owning side to null (unless already changed)
            if ($eterContent->getContentUser() === $this) {
                $eterContent->setContentUser(null);
            }
        }

        return $this;
    }

    public function getUserDescription(): ?string
    {
        return $this->user_description;
    }

    public function setUserDescription(?string $user_description): self
    {
        $this->user_description = $user_description;

        return $this;
    }

    // Les 5 fonctions obligatoires d'après Symfony pour le cryptage du mot de passe
    public function getPassword() {
        return $this->getUserPassword();
    }

    public function getUsername() {
        return $this->getUserMail();
    }

    public function eraseCredentials() {}

    public function getSalt() {
        return "";
    }

    public function getRoles() {
        if ($this->user_role == 'Administrateur')
            return ["ROLE_ADMIN"];
        if ($this->user_role == 'Utilisateur')
            return ["ROLE_USER"];
        return [];
    }

    public function getUserAvatar()
    {
        return $this->user_avatar;
    }

    public function setUserAvatar($user_avatar)
    {
        $this->user_avatar = $user_avatar;

        return $this;
    }


    public function setUserPic(File $user_avatar = null) {
        $this->user_pic = $user_avatar;
        // ajout d'un champs modif datetime dans la bdd pour forcer la persistance
        if ($user_avatar) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->user_update = new \DateTime('now');
        }
    }

    public function getUserPic() {
        return $this->user_pic;
    }

    public function getUserUpdate(): ?\DateTimeInterface
    {
        return $this->user_update;
    }

    public function setUserUpdate(\DateTimeInterface $user_update): self
    {
        $this->user_update = $user_update;

        return $this;
    }

    public function getActivationToken(): ?string
    {
        return $this->activation_token;
    }

    public function setActivationToken(?string $activation_token): self
    {
        $this->activation_token = $activation_token;

        return $this;
    }

    public function getResetToken(): ?string
    {
        return $this->reset_token;
    }

    public function setResetToken(?string $reset_token): self
    {
        $this->reset_token = $reset_token;

        return $this;
    }

    public function getDateInscr(): ?int
    {
        return $this->date_inscr;
    }

    public function setDateInscr(?int $date_inscr): self
    {
        $this->date_inscr = $date_inscr;

        return $this;
    }

    public function getDateLien(): ?int
    {
        return $this->date_lien;
    }

    public function setDateLien(?int $date_lien): self
    {
        $this->date_lien = $date_lien;

        return $this;
    }

    /**
     * @return Collection|EterProduct[]
     */
    public function getEterProducts(): Collection
    {
        return $this->eterProducts;
    }

    public function addEterProduct(EterProduct $eterProduct): self
    {
        if (!$this->eterProducts->contains($eterProduct)) {
            $this->eterProducts[] = $eterProduct;
            $eterProduct->addEterUser($this);
        }

        return $this;
    }

    public function removeEterProduct(EterProduct $eterProduct): self
    {
        if ($this->eterProducts->contains($eterProduct)) {
            $this->eterProducts->removeElement($eterProduct);
            $eterProduct->removeEterUser($this);
        }

        return $this;
    }

    public function getUserOrderDate(): ?\DateTimeInterface
    {
        return $this->user_order_date;
    }

    public function setUserOrderDate(?\DateTimeInterface $user_order_date): self
    {
        $this->user_order_date = $user_order_date;

        return $this;
    }

    public function getUserDesactivate(): ?bool
    {
        return $this->user_desactivate;
    }

    public function setUserDesactivate(bool $user_desactivate): self
    {
        $this->user_desactivate = $user_desactivate;

        return $this;
    }


}
