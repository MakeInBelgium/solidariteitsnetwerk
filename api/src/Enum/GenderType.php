<?php
/**
 * solidariteitsnetwerk: GenderType.php
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 */
namespace App\Enum;

use ApiPlatform\Core\Annotation\ApiResource;
use MyCLabs\Enum\Enum;

/**
 * An enumeration of genders.
 *
 * @see http://schema.org/GenderType Documentation on Schema.org
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 * @ApiResource(iri="http://schema.org/GenderType")
 */
class GenderType extends Enum
{
    /**
     * @var string the female gender
     */
    const FEMALE = 'http://schema.org/Female';

    /**
     * @var string the male gender
     */
    const MALE = 'http://schema.org/Male';
}
