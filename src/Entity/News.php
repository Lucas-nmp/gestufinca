<?php

namespace App\Entity;

use App\Repository\NewsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsRepository::class)]
class News
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $news_date = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $body_news = null;

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

    public function getNewsDate(): ?\DateTime
    {
        return $this->news_date;
    }

    public function setNewsDate(\DateTime $news_date): static
    {
        $this->news_date = $news_date;

        return $this;
    }

    public function getBodyNews(): ?string
    {
        return $this->body_news;
    }

    public function setBodyNews(string $body_news): static
    {
        $this->body_news = $body_news;

        return $this;
    }
}
