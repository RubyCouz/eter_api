<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EterCommentRepository")
 * @ApiResource()
 */
class EterComment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $com_content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $com_date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EterUser", inversedBy="eterComments")
     */
    private $com_user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EterContent", inversedBy="eterComments")
     */
    private $content_com;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EterComment", inversedBy="com_comment")
     */
    private $eterComment;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EterComment", mappedBy="eterComment")
     */
    private $com_comment;

    public function __construct()
    {
        $this->com_comment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComContent(): ?string
    {
        return $this->com_content;
    }

    public function setComContent(string $com_content): self
    {
        $this->com_content = $com_content;

        return $this;
    }

    public function getComDate(): ?\DateTimeInterface
    {
        return $this->com_date;
    }

    public function setComDate(\DateTimeInterface $com_date): self
    {
        $this->com_date = $com_date;

        return $this;
    }

    public function getComUser(): ?EterUser
    {
        return $this->com_user;
    }

    public function setComUser(?EterUser $com_user): self
    {
        $this->com_user = $com_user;

        return $this;
    }

    public function getContentCom(): ?EterContent
    {
        return $this->content_com;
    }

    public function setContentCom(?EterContent $content_com): self
    {
        $this->content_com = $content_com;

        return $this;
    }

    public function getEterComment(): ?self
    {
        return $this->eterComment;
    }

    public function setEterComment(?self $eterComment): self
    {
        $this->eterComment = $eterComment;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getComComment(): Collection
    {
        return $this->com_comment;
    }

    public function addComComment(self $comComment): self
    {
        if (!$this->com_comment->contains($comComment)) {
            $this->com_comment[] = $comComment;
            $comComment->setEterComment($this);
        }

        return $this;
    }

    public function removeComComment(self $comComment): self
    {
        if ($this->com_comment->contains($comComment)) {
            $this->com_comment->removeElement($comComment);
            // set the owning side to null (unless already changed)
            if ($comComment->getEterComment() === $this) {
                $comComment->setEterComment(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->com_content;
    }

}
