<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $path;

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\ManyToOne(targetEntity: Trick::class, inversedBy: 'medias')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Trick $trickMedia;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTrickMedia(): ?Trick
    {
        return $this->trickMedia;
    }

    public function setTrickMedia(?Trick $trickMedia): self
    {
        $this->trickMedia = $trickMedia;

        return $this;
    }
}
