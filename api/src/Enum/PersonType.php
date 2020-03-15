<?php
/**
 * solidariteitsnetwerk: PersonType.php
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 */

namespace App\Enum;

use ApiPlatform\Core\Annotation\ApiResource;
use MyCLabs\Enum\Enum;

/**
 * An enumeration of animal types.
 *
 * @see http://schema.org/Enumeration Documentation on Schema.org
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 * @ApiResource(iri="http://schema.org/Enumeration")
 */
class PersonType extends Enum
{
    /**
     * @var string VOLUNTEER
     */
    const VOLUNTEER = 'volunteer';

    /**
     * @var string SENIOR
     */
    const SENIOR = 'senior';
}
