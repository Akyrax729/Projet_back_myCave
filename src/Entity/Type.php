<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    /**
     * @var Collection<int, wine>
     */
    #[ORM\ManyToMany(targetEntity: wine::class, inversedBy: 'types')]
    private Collection $wine;

    public function __construct()
    {
        $this->wine = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, wine>
     */
    public function getWine(): Collection
    {
        return $this->wine;
    }

    public function addWine(wine $wine): static
    {
        if (!$this->wine->contains($wine)) {
            $this->wine->add($wine);
        }

        return $this;
    }

    public function removeWine(wine $wine): static
    {
        $this->wine->removeElement($wine);

        return $this;
    }
}
