<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressRepository::class)]

class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private ?int $id = null;

    #[ORM\Column(length: 255)]

    private ?string $number = null;

    #[ORM\Column(length: 255)]

    private ?string $street = null;

    #[ORM\Column(length: 255, nullable: true)]

    private ?string $additionnal = null;

    #[ORM\Column(length: 255)]

    private ?string $postcode = null;

    #[ORM\Column(length: 255)]

    private ?string $city = null;

    #[ORM\ManyToOne(inversedBy: 'addresses')]

    private ?User $userAddress = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): static
    {
        $this->street = $street;

        return $this;
    }

    public function getAdditionnal(): ?string
    {
        return $this->additionnal;
    }

    public function setAdditionnal(?string $additionnal): static
    {
        $this->additionnal = $additionnal;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): static
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getUserAddress(): ?User
    {
        return $this->userAddress;
    }

    public function setUserAddress(?User $userAddress): static
    {
        $this->userAddress = $userAddress;

        return $this;
    }
}
