<?php
/**
 * solidariteitsnetwerk: Person.php
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Annotation\ApiFilter;
use App\Filter\MultiSearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use App\Enum\PersonType;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Traits\Blameable;
use App\Entity\Traits\Timestampable;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A person (alive, dead, undead, or fictional).
 *
 * @see http://schema.org/Person Documentation on Schema.org
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 *
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 * @ApiResource(
 *     iri="http://schema.org/Person",
 *     description="sdsd",
 *     normalizationContext={"groups"={"person:read", "postaladdress:read"}},
 *     denormalizationContext={"groups"={"person:write", "postaladdress:write"}},
 * )
 * @ApiFilter(DateFilter::class, properties={"createdAt", "updatedAt"})
 * @ApiFilter(SearchFilter::class, properties={
 *     "type": "exact",
 *     "gender": "exact",
 *     "address.addressRegion": "ipartial",
 *     "address.addressLocality": "ipartial",
 * })
 * @ApiFilter(
 *     MultiSearchFilter::class, properties={
 *         "q": {"givenName", "familyName", "email"}
 *     }
 * )
 * @ApiFilter(
 *     OrderFilter::class,
 *     properties={
 *     "givenName",
 *     "familyName",
 *     "email",
 *     "type",
 *     "gender",
 *     "createdAt",
 *     "updatedAt"
 * })
 */
class Person
{
    use Timestampable;
    use Blameable;

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
     * @var string|null Given name. In the U.S., the first name of a Person. This can be used along with familyName instead of the name property.
     *
     * @ORM\Column(type="text")
     * @ApiProperty(iri="http://schema.org/givenName")
     * @Assert\Type(type="string")
     * @Assert\NotBlank()
     * @Groups({"person:read", "person:write"})
     */
    private $givenName;

    /**
     * @var string|null Family name. In the U.S., the last name of an Person. This can be used along with givenName instead of the name property.
     *
     * @ORM\Column(type="text")
     * @ApiProperty(iri="http://schema.org/familyName")
     * @Assert\Type(type="string")
     * @Assert\NotBlank()
     * @Groups({"person:read", "person:write"})
     */
    private $familyName;

    /**
     * @var string|null email address
     *
     * @ORM\Column(type="text", nullable=true, unique=true)
     * @ApiProperty(iri="http://schema.org/email")
     * @Assert\Email
     * @Groups({"person:read", "person:write"})
     */
    private $email;

    /**
     * @var string|null phone number
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="https://schema.org/telephone")
     * @Assert\NotBlank(allowNull=true)
     * @Groups({"person:read", "person:write"})
     */
    private $phoneNumber;

    /**
     * @var PersonType|null PersonType
     *
     * @ORM\Column(type=PersonType::class, nullable=false)
     * @ApiProperty(iri="http://schema.org/Enumeration", attributes={
     *          "jsonld_context"={
     *              "type"=PersonType::class,
     *              "enum"={"volunteer", "senior"},
     *              "example"="senior"
     *           }
     *     })
     * @Assert\Type(type="string")
     * @Groups({"person:read", "person:write"})
     */
    private $type = PersonType::SENIOR;

    /**
     * @var PostalAddress|null physical address of the item
     *
     * @ORM\OneToOne(targetEntity="App\Entity\PostalAddress", cascade={"persist"})
     * @ApiProperty(iri="http://schema.org/address")
     * @ApiSubresource()
     * @Groups({"person:read", "person:write"})
     * @Assert\Valid
     */
    private $address;

    /**
     * @var string|null GenderType of the person. While http://schema.org/Male and http://schema.org/Female may be used, text strings are also acceptable for people who do not identify as a binary gender.
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/gender")
     * @Assert\Type(type="string")
     * @Groups({"person:read", "person:write"})
     */
    private $gender;

    /**
     * @var string|null a description of the item
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/description")
     * @Assert\Type(type="string")
     * @Groups({"person:read", "person:write"})
     */
    private $description;

    public function getId(): ?UuidInterface
    {
        return $this->id;
    }

    public function setGivenName(?string $givenName): self
    {
        $this->givenName = $givenName;

        return $this;
    }

    public function getGivenName(): ?string
    {
        return $this->givenName;
    }

    public function setFamilyName(?string $familyName): self
    {
        $this->familyName = $familyName;

        return $this;
    }

    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setAddress(?PostalAddress $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAddress(): ?PostalAddress
    {
        return $this->address;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }


    /**
     * @return PersonType
     */
    public function getType(): PersonType
    {
        return $this->type;
    }

    /**
     * @param PersonType|string $type
     *
     * @return Person
     */
    public function setType($type): Person
    {
        $type = $type instanceof PersonType ? $type : constant(PersonType::class . '::' . $type);

        $this->type = $type;

        return $this;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @ApiProperty(iri="http://schema.org/name")
     * @Groups({"person:read", "carecase:read"})
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->__toString();
    }

    public function __toString()
    {
        return sprintf('%s %s (%s)', $this->givenName, $this->familyName, $this->getAddress()->getAddressRegion());
    }
}
