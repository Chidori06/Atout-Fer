<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\CategoryServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategoryServiceRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            normalizationContext: ['groups' => ['read_all']],
        ),
        new Get(),
        new Post(security: "is_granted('ROLE_ADMIN')"),
        new Put(security: "is_granted('ROLE_ADMIN')"),
        new Patch(security: "is_granted('ROLE_ADMIN')"),
        new Delete(security: "is_granted('ROLE_ADMIN')")
    ]
)]

class CategoryService
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read_all'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Veuillez saisir un prix')]
    #[Groups(['read_all'])]
    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'categoriesService')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message: 'Veuillez choisir une catégorie')]
    #[Groups(['read_all'])]
    private ?Category $categories = null;

    #[ORM\ManyToOne(inversedBy: 'servicesCategory')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message: 'Veuillez choisir un service')]
    #[Groups(['read_all'])]
    private ?Service $services = null;

    #[ORM\OneToMany(mappedBy: 'catServLines', targetEntity: OrderLine::class)]
    private Collection $catSerLine;

    public function __construct()
    {
        $this->catSerLine = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCategories(): ?Category
    {
        return $this->categories;
    }

    public function setCategories(?Category $categories): static
    {
        $this->categories = $categories;

        return $this;
    }

    public function getServices(): ?Service
    {
        return $this->services;
    }

    public function setServices(?Service $services): static
    {
        $this->services = $services;

        return $this;
    }

    /**
     * @return Collection<int, OrderLine>
     */
    public function getCatSerLine(): Collection
    {
        return $this->catSerLine;
    }

    public function addCatSerLine(OrderLine $catSerLine): static
    {
        if (!$this->catSerLine->contains($catSerLine)) {
            $this->catSerLine->add($catSerLine);
            $catSerLine->setCatServLines($this);
        }

        return $this;
    }

    public function removeCatSerLine(OrderLine $catSerLine): static
    {
        if ($this->catSerLine->removeElement($catSerLine)) {
            // set the owning side to null (unless already changed)
            if ($catSerLine->getCatServLines() === $this) {
                $catSerLine->setCatServLines(null);
            }
        }

        return $this;
    }



}
