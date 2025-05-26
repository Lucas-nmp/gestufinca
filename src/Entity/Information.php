<?php

namespace App\Entity;

use App\Repository\InformationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InformationRepository::class)]
class Information
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dare_information = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $body_information = null;

    #[ORM\Column(length: 255)]
    private ?string $community = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDareInformation(): ?\DateTime
    {
        return $this->dare_information;
    }

    public function setDareInformation(\DateTime $dare_information): static
    {
        $this->dare_information = $dare_information;

        return $this;
    }

    public function getBodyInformation(): ?string
    {
        return $this->body_information;
    }

    public function setBodyInformation(string $body_information): static
    {
        $this->body_information = $body_information;

        return $this;
    }

    public function getCommunity(): ?string
    {
        return $this->community;
    }

    public function setCommunity(string $community): static
    {
        $this->community = $community;

        return $this;
    }
}
