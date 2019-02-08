<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\Recherche;
use App\Form\RechercheSearchType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Property::class);
    }
    public function findvisibleQuery():QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->Where('p.sold = false and p.allowed=true')
            ->getQuery()
            ->getResult();

    }
    /*
     * @return Property
     */
    public function findallvisible(){
        return $this->createQueryBuilder('p')
            ->Where('p.sold = false and p.allowed=true')
            ->getQuery()
            ->getResult();
    }


    private function findVisibleQuerys():QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->Where('p.sold = false and p.allowed=true');
    }


    public function findlatest():array
    {
        return $this->createQueryBuilder('p')
            ->Where('p.sold = false and p.allowed=true')
            ->setMaxResults(4)
            ->orderBy('p.created_at','desc')
            ->getQuery()
            ->getResult();
    }


    public function ecritepar($connecteduser):array
    {
        return $this->createQueryBuilder('p')
            ->Where('p.createdby = :connecteduser')
            ->setParameter('connecteduser', $connecteduser)
            ->orderBy('p.created_at','desc')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param Recherche $recherche
     * @return array
     */
    public function findvisibleQueryPrime(Recherche $recherche):array
    {
        $query=$this->createQueryBuilder('p')
                    ->Where('p.sold = false and p.allowed=true  and p.city=:city and p.token=:token and p.surface<:surface and p.categ=:categ ')
                    ->setParameter('city',$recherche->getCity())
                    ->setParameter('token',$recherche->getToken())
                    ->setParameter('surface',$recherche->getSurface())
                    ->setParameter('categ',$recherche->getCateg())




            ->getQuery()
            ->getResult();


        return $query;

    }



    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
