<?php
/**
 * solidariteitsnetwerk: PostalAddress.php
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 */
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * The mailing address.
 *
 * @see http://schema.org/PostalAddress Documentation on Schema.org
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 *
 * @ORM\Entity
 * @ApiResource(
 *     iri="http://schema.org/PostalAddress",
 *     normalizationContext={"jsonld_embed_context"=true}
 * )
 */
class PostalAddress
{
    /**
     * @var UuidInterface
     *
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @var string|null The street address. For example, 1600 Amphitheatre Pkwy.
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/streetAddress")
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     * @Groups({"person:read", "person:write", "postaladdress:read", "postaladdress:write"})
     */
    private $streetAddress;

    /**
     * @var string|null The postal code. For example, 94043.
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/postalCode")
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     * @Groups({"person:read", "person:write", "postaladdress:read", "postaladdress:write"})
     */
    private $postalCode;

    /**
     * @var string|null The locality. For example, Mountain View.
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/addressLocality")
     * @Assert\Type(type="string")
     * @Assert\NotBlank()
     * @Groups({"person:read", "person:write", "postaladdress:read", "postaladdress:write"})
     */
    private $addressLocality;

    /**
     * @var string|null The region. For example, CA.
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/addressRegion", required=false)
     * @Assert\NotBlank(allowNull=true)
     * @Groups({"person:read", "person:write", "postaladdress:read", "postaladdress:write"})
     */
    private $addressRegion;

    /**
     * @var string|null The country. For example, USA. You can also provide the two-letter \[ISO 3166-1 alpha-2 country code\](http://en.wikipedia.org/wiki/ISO\_3166-1).
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/addressCountry")
     * @Assert\Type(type="string")
     * @Assert\NotBlank(allowNull=true)
     * @Groups({"person:read", "person:write", "postaladdress:read", "postaladdress:write"})
     */
    private $addressCountry = 'Belgium';

    public function getId(): ?UuidInterface
    {
        return $this->id;
    }

    public function setStreetAddress(?string $streetAddress): self
    {
        $this->streetAddress = $streetAddress;

        return $this;
    }

    public function getStreetAddress(): ?string
    {
        return $this->streetAddress;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setAddressLocality(?string $addressLocality): self
    {
        $this->addressLocality = $addressLocality;

        return $this;
    }

    public function getAddressLocality(): ?string
    {
        return $this->addressLocality;
    }

    public function setAddressRegion(?string $addressRegion): self
    {
        $this->addressRegion = $addressRegion;

        return $this;
    }

    public function getAddressRegion(): ?string
    {
        return $this->addressRegion;
    }

    public function setAddressCountry(?string $addressCountry): self
    {
        $this->addressCountry = $addressCountry;

        return $this;
    }

    public function getAddressCountry(): ?string
    {
        return $this->addressCountry;
    }
}
