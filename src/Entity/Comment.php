<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $isApproved = false;

    #[ORM\Column(type: 'integer', options: ['default' => 0])]
    private int $likes = 0;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?Post $post = null;

    public function getId(): ?int { return $this->id; }

    public function isApproved(): bool { return $this->isApproved; }
    public function setIsApproved(bool $isApproved): self { $this->isApproved = $isApproved; return $this; }

    public function getLikes(): int { return $this->likes; }
    public function setLikes(int $likes): self { $this->likes = $likes; return $this; }

    public function getPost(): ?Post { return $this->post; }
    public function setPost(?Post $post): self { $this->post = $post; return $this; }
}