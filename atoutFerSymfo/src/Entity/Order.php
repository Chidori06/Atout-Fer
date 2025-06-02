<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;


#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
#[ApiResource(
    operations: [
        new GetCollection(
            normalizationContext: ['groups' => ['read_all']]
        ),
        new Get(
            normalizationContext: ['groups' => ['infos']]
        ),
        new Post(denormalizationContext: ['groups' => ['post']]),
        new Put(security: "is_granted('ROLE_ADMIN')"),
        new Patch(security: "is_granted('ROLE_ADMIN')"),
        new Delete(security: "is_granted('ROLE_ADMIN')")
    ]
)]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read_all', 'post'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['read_all', 'post'])]
    private ?float $total = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read_all', 'post'])]
    private ?string $payment = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['read_all', 'post'])]
    private ?\DateTimeInterface $orderDate = null;

    #[ORM\ManyToOne(cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read_all', 'post'])]
    private ?Address $address = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['infos', 'read_all', 'post'])]
    private ?User $user = null;


    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read_all', 'post'])]
    private ?Status $statusOrder = null;

    #[ORM\OneToMany(mappedBy: 'orders', targetEntity: OrderLine::class)]
    #[Groups(['read_all', 'post'])]
    private Collection $linesOrder;

    public function __construct()
    {
        $this->linesOrder = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getPayment(): ?string
    {
        return $this->payment;
    }

    public function setPayment(string $payment): static
    {
        $this->payment = $payment;

        return $this;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): static
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }


    public function getStatusOrder(): ?Status
    {
        return $this->statusOrder;
    }

    public function setStatusOrder(?Status $statusOrder): static
    {
        $this->statusOrder = $statusOrder;

        return $this;
    }

    /**
     * @return Collection<int, OrderLine>
     */
    public function getLinesOrder(): Collection
    {
        return $this->linesOrder;
    }

    public function addLinesOrder(OrderLine $linesOrder): static
    {
        if (!$this->linesOrder->contains($linesOrder)) {
            $this->linesOrder->add($linesOrder);
            $linesOrder->setOrders($this);
        }

        return $this;
    }

    public function removeLinesOrder(OrderLine $linesOrder): static
    {
        if ($this->linesOrder->removeElement($linesOrder)) {
            // set the owning side to null (unless already changed)
            if ($linesOrder->getOrders() === $this) {
                $linesOrder->setOrders(null);
            }
        }

        return $this;
    }

}
