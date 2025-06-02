<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(normalizationContext: ['groups' => ['read_all']]),
        new Get(normalizationContext: ['groups' => ['read']]),
        new Post(security: "isGranted('ROLE_ADMIN')"),
        new Put(security: "isGranted('ROLE_ADMIN')"),
        new Patch(security: "isGranted('ROLE_ADMIN')"),
        new Delete(security: "isGranted('ROLE_ADMIN')")
    ]
)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read_all', 'read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez saisir un nom de service')]
    #[Groups(['read_all', 'read'])]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: CategoryService::class, mappedBy: 'services')]
    private Collection $servicesCategory;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read_all'])]
    private ?string $image = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\NotBlank(message: 'Veuillez saisir une description')]
    #[Groups(['read_all'])]
    private ?string $description = null;

    public function __construct()
    {
        $this->servicesCategory = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, CategoryService>
     */
    public function getServicesCategory(): Collection
    {
        return $this->servicesCategory;
    }

    public function addServicesCategory(CategoryService $servicesCategory): static
    {
        if (!$this->servicesCategory->contains($servicesCategory)) {
            $this->servicesCategory->add($servicesCategory);
            $servicesCategory->setServices($this);
        }

        return $this;
    }

    public function removeServicesCategory(CategoryService $servicesCategory): static
    {
        if ($this->servicesCategory->removeElement($servicesCategory)) {
            // set the owning side to null (unless already changed)
            if ($servicesCategory->getServices() === $this) {
                $servicesCategory->setServices(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
