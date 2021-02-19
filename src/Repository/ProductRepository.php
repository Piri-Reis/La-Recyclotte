<?php

namespace App\Repository;


use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    // formulaire de recherche generale
    public function search ($query)
    { 
        $stmt = $this->createQueryBuilder('p');
    
        $stmt->where('p.name LIKE :query');
        $stmt->orwhere('c.name LIKE :query');
        $stmt->orwhere('p.city LIKE :query');

        $stmt->setParameter('query', '%' . $query . '%');

        return $stmt->getQuery()->getResult();
    }

}
