<?php
/**
 * solidariteitsnetwerk: DashboardAction.php
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 */

namespace App\Controller;

use App\Entity\Person;
use App\Entity\CareCase;
use App\Repository\CareCaseRepository;
use App\Repository\PersonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DashboardAction
 * @package App\Controller
 */
final class DashboardAction
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * EventDeadlineAction constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        /** @var PersonRepository $repository */
        $personRepository = $this->em->getRepository(Person::class);

        /** @var CareCaseRepository $repository */
        $careCaseRepository = $this->em->getRepository(CareCase::class);

        return JsonResponse::create([
            'care_cases_by_status' => $careCaseRepository->getSummary(),
            'people_status' => $personRepository->getSummary(),
        ]);
    }
}
