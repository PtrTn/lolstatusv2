<?php

namespace Repository;

use Doctrine\ORM\EntityRepository;
use Model\StatusUpdate;

class StatusUpdateRepository extends EntityRepository
{
    public function save(StatusUpdate $statusUpdate) : void
    {
        $em =  $this->getEntityManager();
        $em->persist($statusUpdate);
        $em->flush();
        return;
    }

    public function findUpdate(string $updateId, string $incidentId, string $region) : ?StatusUpdate
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('su')
            ->from(StatusUpdate::class, 'su')
            ->where('su.incidentId = :incidentId')
            ->where('su.updateId = :updateId')
            ->andWhere('su.region = :region')
            ->setMaxResults(1)
            ->setParameters([
                'incidentId' => $incidentId,
                'udpateId' => $updateId,
                'region' => $region
            ]);
        $result = $qb->getQuery()->getResult();
        if (count($result) === 1) {
            return reset($result);
        }
        return null;
    }
}
