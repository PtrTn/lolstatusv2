<?php

namespace Repository;

use Doctrine\ORM\EntityRepository;
use Model\Incident;

class IncidentRepository extends EntityRepository
{
    public function save(Incident $incident) : void
    {
        $em =  $this->getEntityManager();
        $em->persist($incident);
        $em->flush();
        return;
    }

    public function remove(Incident $incident) : void
    {
        $em =  $this->getEntityManager();
        $em->remove($incident);
        $em->flush();
        return;
    }

    public function findIncident(Incident $incident) : ?Incident
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('i')
            ->from(Incident::class, 'i')
            ->where('i.incidentId = :incidentId')
            ->andWhere('i.region = :region')
            ->setMaxResults(1)
            ->setParameters([
                'incidentId' => $incident->getIncidentId(),
                'region' => $incident->getRegion()
            ]);
        $result = $qb->getQuery()->getResult();
        if (count($result) === 1) {
            return reset($result);
        }
        return null;
    }
}
