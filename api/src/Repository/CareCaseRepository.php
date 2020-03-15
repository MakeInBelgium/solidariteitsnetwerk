<?php
/**
 * solidariteitsnetwerk: CareCaseRepository.php
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 */

namespace App\Repository;

use App\Entity\CareCase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CareCase|null find($id, $lockMode = null, $lockVersion = null)
 * @method CareCase|null findOneBy(array $criteria, array $orderBy = null)
 * @method CareCase[]    findAll()
 * @method CareCase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CareCaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CareCase::class);
    }

    public function getSummary() {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('status', 'status');
        $rsm->addScalarResult('total', 'total');

        $query = $this->getEntityManager()
                      ->createNativeQuery(<<<QUERY
SELECT
    status,
    count(*) as total
FROM care_case
    GROUP BY status
QUERY
, $rsm);
            return $query->getResult(AbstractQuery::HYDRATE_ARRAY);
    }
}
