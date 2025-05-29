<?php

namespace App\Entity;

use App\Repository\OpinionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpinionsRepository::class)]
class Opinions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameNeighbor = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateOpinion = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $body = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameNeighbor(): ?string
    {
        return $this->nameNeighbor;
    }

    public function setNameNeighbor(string $nameNeighbor): static
    {
        $this->nameNeighbor = $nameNeighbor;

        return $this;
    }

    public function getDateOpinion(): ?\DateTime
    {
        return $this->dateOpinion;
    }

    public function setDateOpinion(\DateTime $dateOpinion): static
    {
        $this->dateOpinion = $dateOpinion;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): static
    {
        $this->body = $body;

        return $this;
    }
}
