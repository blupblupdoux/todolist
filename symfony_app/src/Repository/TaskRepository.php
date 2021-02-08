<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use function Symfony\Component\DependencyInjection\Loader\Configurator\param;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function findTasks()
    {
        return $this->createQueryBuilder('t')
            ->select('t, c')
            ->leftJoin('t.category', 'c')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findTask($id)
    {
        return $this->createQueryBuilder('t')
            ->select('t, c')
            ->leftJoin('t.category', 'c')
            ->where('t.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findTasksStatus($status)
    {
        return $this->createQueryBuilder('t')
            ->select('t, c')
            ->leftJoin('t.category', 'c')
            ->where('t.status = :status')
            ->setParameter('status', $status)
            ->getQuery()
            ->getResult()
        ;
    }
}
