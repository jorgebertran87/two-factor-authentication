<?php

namespace App\Authenticator\Infrastructure\Doctrine;

use App\Authenticator\Application\VerificationReadRepository;
use App\Authenticator\Application\VerificationWriteRepository;
use App\Authenticator\Domain\Verification as DomainVerification;
use App\Entity\Verification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Verification|null find($id, $lockMode = null, $lockVersion = null)
 * @method Verification|null findOneBy(array $criteria, array $orderBy = null)
 * @method Verification[]    findAll()
 * @method Verification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VerificationRepository extends ServiceEntityRepository implements VerificationReadRepository, VerificationWriteRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Verification::class);
    }

    public function findById(string $id): ?DomainVerification
    {
        $result =  $this->createQueryBuilder('v')
            ->andWhere('v.id = :id')
            ->setParameter('id', $id)
            ->orderBy('v.generated_at DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();

        return null;
    }

    public function findByIdAndCode(string $id, string $code): ?DomainVerification
    {
        $result =  $this->createQueryBuilder('v')
            ->andWhere('v.id = :id')
            ->andWhere('v.code = :code')
            ->setParameter('id', $id)
            ->setParameter('code', $code)
            ->orderBy('v.generated_at DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();

        return null;
    }

    public function save(DomainVerification $verification): void
    {
        $verificationEntity = new Verification();
        $verificationEntity->setCode($verification->code()->value());
        $verificationEntity->setGeneratedAt($verification->code()->generatedAt());
        $verificationEntity->setPhoneNumber($verification->phone()->number());
        $verificationEntity->setId((string)$verification->id());

        $this->getEntityManager()->persist($verificationEntity);
        $this->getEntityManager()->flush();
    }
}
