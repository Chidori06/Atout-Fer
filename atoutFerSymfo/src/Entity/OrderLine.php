<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\OrderLineRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: OrderLineRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Post(),
        new Put(security: "is_granted('ROLE_ADMIN')"),
        new Patch(security: "is_granted('ROLE_ADMIN')"),
        new Delete(security: "is_granted('ROLE_ADMIN')")
    ]
)]
class OrderLine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'catSerLine')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategoryService $catServLines = null;

    #[ORM\ManyToOne(inversedBy: 'linesOrder')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Order $orders = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatServLines(): ?CategoryService
    {
        return $this->catServLines;
    }

    public function setCatServLines(?CategoryService $catServLines): static
    {
        $this->catServLines = $catServLines;

        return $this;
    }

    public function getOrders(): ?Order
    {
        return $this->orders;
    }

    public function setOrders(?Order $orders): static
    {
        $this->orders = $orders;

        return $this;
    }


}
