<?php

namespace App\Entity;

use App\Repository\CommunityRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Information;

#[ORM\Entity(repositoryClass: CommunityRepository::class)]
class Community
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column(length: 255)]
    private ?string $locality = null;

    #[ORM\Column]
    private ?int $neighborsCount = null;

    #[ORM\Column]
    private ?int $id_neighbor = null;

    #[ORM\OneToMany(mappedBy: 'community', targetEntity: Information::class)]
    private Collection $information;

    /**
     * @var Collection<int, Neighbor>
     */
    #[ORM\OneToMany(targetEntity: Neighbor::class, mappedBy: 'community')]
    private Collection $neighbors;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getLocality(): ?string
    {
        return $this->locality;
    }

    public function setLocality(string $locality): static
    {
        $this->locality = $locality;

        return $this;
    }

    public function getNeighborsCount(): ?int
    {
        return $this->neighborsCount;
    }

    public function setNeighborsCount(int $neighborsCount): static
    {
        $this->neighborsCount = $neighborsCount;

        return $this;
    }

    public function getIdNeighbor(): ?int
    {
        return $this->id_neighbor;
    }

    public function setIdNeighbor(int $id_neighbor): static
    {
        $this->id_neighbor = $id_neighbor;

        return $this;
    }

    public function __construct()
    {
        $this->information = new ArrayCollection();
        $this->neighbors = new ArrayCollection();
    }

    public function getInformation(): Collection
    {
        return $this->information;
    }

    /**
     * @return Collection<int, Neighbor>
     */
    public function getNeighbors(): Collection
    {
        return $this->neighbors;
    }

    public function addNeighbor(Neighbor $neighbor): static
    {
        if (!$this->neighbors->contains($neighbor)) {
            $this->neighbors->add($neighbor);
            $neighbor->setCommunity($this);
        }

        return $this;
    }

    public function removeNeighbor(Neighbor $neighbor): static
    {
        if ($this->neighbors->removeElement($neighbor)) {
            // set the owning side to null (unless already changed)
            if ($neighbor->getCommunity() === $this) {
                $neighbor->setCommunity(null);
            }
        }

        return $this;
    }
}
