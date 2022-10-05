<?php

namespace App\Entity;

use App\Repository\SecteurActivitesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SecteurActivitesRepository::class)]
class SecteurActivites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $intitule = null;

    #[ORM\ManyToOne(inversedBy: 'secteurActivites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $user = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'secteurActivites')]
    private ?self $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class)]
    private Collection $secteurActivites;

    public function __construct()
    {
        $this->secteurActivites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getUser(): ?Client
    {
        return $this->user;
    }

    public function setUser(?Client $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getSecteurActivites(): Collection
    {
        return $this->secteurActivites;
    }

    public function addSecteurActivite(self $secteurActivite): self
    {
        if (!$this->secteurActivites->contains($secteurActivite)) {
            $this->secteurActivites->add($secteurActivite);
            $secteurActivite->setParent($this);
        }

        return $this;
    }

    public function removeSecteurActivite(self $secteurActivite): self
    {
        if ($this->secteurActivites->removeElement($secteurActivite)) {
            // set the owning side to null (unless already changed)
            if ($secteurActivite->getParent() === $this) {
                $secteurActivite->setParent(null);
            }
        }

        return $this;
    }
}
