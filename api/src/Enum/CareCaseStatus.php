<?php
/**
 * solidariteitsnetwerk: CareCaseStatus.php
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 */

namespace App\Enum;

use ApiPlatform\Core\Annotation\ApiResource;
use MyCLabs\Enum\Enum;

/**
 * An enumeration of animal statuses.
 *
 * @see http://schema.org/Enumeration Documentation on Schema.org
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 * @ApiResource(iri="http://schema.org/Enumeration")
 */
class CareCaseStatus extends Enum
{
    /**
     * @var string new
     */
    const NEW = 'new';

    /**
     * @var string assigned
     */
    const ASSIGNED = 'assigned';

    /**
     * @var string accepted
     */
    const ACCEPTED = 'accepted';

    /**
     * @var string accepted
     */
    const REJECTED = 'rejected';

    /**
     * @var string ongoing
     */
    const ONGOING = 'ongoing';

    /**
     * @var string done
     */
    const DONE = 'done';
}
