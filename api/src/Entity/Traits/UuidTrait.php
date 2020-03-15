<?php
/**
 * solidariteitsnetwerk: UuidTrait.php
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 */

namespace App\Entity\Traits;

use ApiPlatform\Core\Annotation\ApiProperty;

trait UuidTrait
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="App\Doctrine\Generator\UuidGenerator")
     * @ApiProperty(iri="http://schema.org/identifier")
     */
    private $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return UuidTrait
     */
    public function setId(string $id): UuidTrait
    {
        $this->id = $id;

        return $this;
    }
}
