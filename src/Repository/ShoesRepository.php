<?php

namespace App\Repository;

use App\Entity\Shoes;
use App\Form\SearchFormType;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Shoes>
 *
 * @method Shoes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shoes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shoes[]    findAll()
 * @method Shoes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShoesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shoes::class);
    }

    public function save(Shoes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Shoes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function search(array $formData): array
    {
        
         $query = $this->createQueryBuilder('r');
            

        
         if(!empty($formData["price"])) {
             $query
             ->andWhere('r.price = :price')
             ->setParameter('price', $formData["price"])
             ;
         }

         if(!empty($formData["size"])) {
            $query
            ->andWhere('r.size = :size')
            ->setParameter('size', $formData["size"])
            ;
        }

       
        if(!empty($formData["name"])) {
            $query
            ->andWhere('r.name = :name')
            ->setParameter('name', $formData["name"])
            ;
        }
        if(!empty($formData["sex"])) {
            $query
            ->andWhere('r.sex = :sex')
            ->setParameter('sex', $formData["sex"])
            ;
        }
        if(!empty($formData["category"])) {
            $query
            ->andWhere('r.category = :category')
            ->setParameter('category', $formData["category"])
            ;
        }
        if (!empty($formData["dateadd"])) {
            $array = explode(' ', $formData["dateadd"]);
            $query
                ->orderBy($array[0], $array[1]);
        }
        
        return $query->getQuery()
                        ->getResult()
                
        ;
        
    }
//    /**
//     * @return Shoes[] Returns an array of Shoes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Shoes
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
