<?php
/**
 * solidariteitsnetwerk: PersonRepository.php
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 */


namespace App\Repository;

use App\Entity\Person;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Person|null find($id, $lockMode = null, $lockVersion = null)
 * @method Person|null findOneBy(array $criteria, array $orderBy = null)
 * @method Person[]    findAll()
 * @method Person[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Person::class);
    }

    public function getSummary() {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('type', 'type');
        $rsm->addScalarResult('total', 'total');

        $query = $this->getEntityManager()
                      ->createNativeQuery(<<<QUERY
SELECT
    type,
    count(*) as total
FROM person
    GROUP BY type
QUERY
, $rsm);
        return $query->getResult(AbstractQuery::HYDRATE_ARRAY);
    }
}
