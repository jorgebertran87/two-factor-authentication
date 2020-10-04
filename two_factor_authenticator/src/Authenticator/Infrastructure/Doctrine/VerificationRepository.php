<?php

namespace App\Authenticator\Infrastructure\Doctrine;

use App\Authenticator\Application\VerificationReadRepository;
use App\Authenticator\Application\VerificationWriteRepository;
use App\Authenticator\Domain\Code;
use App\Authenticator\Domain\Id;
use App\Authenticator\Domain\Phone;
use App\Authenticator\Domain\Verification as DomainVerification;
use App\Entity\Verification;
use DateTimeImmutable;
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
            ->orderBy('v.generatedAt', 'DESC')
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
            ->orderBy('v.generatedAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();



        if (count($result) > 0) {
            $row = $result[0];

            $id = new Id($row->getId());
            $generatedAt = DateTimeImmutable::createFromMutable($row->getGeneratedAt());
            $code = new Code($row->getCode(), $generatedAt);
            $phone = new Phone($row->getPhoneNumber());
            $verification = new DomainVerification($id, $code, $phone);
            return $verification;
        }

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
