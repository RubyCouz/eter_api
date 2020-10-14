<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EterStateRepository")
 * @ApiResource()
 */
class EterState
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $state_name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EterContent", mappedBy="content_state")
     */
    private $eterContents;

    public function __construct()
    {
        $this->eterContents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStateName(): ?string
    {
        return $this->state_name;
    }

    public function setStateName(string $state_name): self
    {
        $this->state_name = $state_name;

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
            $eterContent->setContentState($this);
        }

        return $this;
    }

    public function removeEterContent(EterContent $eterContent): self
    {
        if ($this->eterContents->contains($eterContent)) {
            $this->eterContents->removeElement($eterContent);
            // set the owning side to null (unless already changed)
            if ($eterContent->getContentState() === $this) {
                $eterContent->setContentState(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->state_name;
    }

}
