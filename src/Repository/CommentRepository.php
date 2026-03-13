<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Comment>
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function findCommentWithMaxLikes(): ?Comment
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.likes', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findApprovedComments(): Collection
    {
        return $this->createQueryBuilder('c')
            ->where('c.isApproved = :approved')
            ->setParameter('approved', true)
            ->getQuery()
            ->getResult();
    }
    
    public function findApprovedCommentsByPost(int $postId): Collection
    {
        return $this->createQueryBuilder('c')
            ->where('c.isApproved = :approved')
            ->andWhere('c.post = :postId')
            ->setParameter('approved', true)
            ->setParameter('postId', $postId)
            ->getQuery()
            ->getResult();
    }
}