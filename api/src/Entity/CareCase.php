<?php
/**
 * solidariteitsnetwerk: CareCase.php
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use App\Filter\MultiSearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use App\Entity\Traits\Blameable;
use App\Entity\Traits\Timestampable;
use App\Enum\CareCaseStatus;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table
 * @ORM\Entity(repositoryClass="App\Repository\CareCaseRepository")
 * @ApiResource(
 *     normalizationContext={"groups"={"read", "carecase:read"}},
 *     denormalizationContext={"groups"={"write", "carecase:write"}},
 * )
 * @ApiFilter(DateFilter::class, properties={"createdAt", "updatedAt"})
 * @ApiFilter(SearchFilter::class, properties={
 *     "status": "exact",
 *     "description": "ipartial",
 * })
 * @ApiFilter(
 *     MultiSearchFilter::class, properties={
 *         "q": {"caseName", "description", "senior.givenName", "senior.familyName", "volunteer.givenName", "volunteer.familyName"}
 *     }
 * )
 * @ApiFilter(
 *     OrderFilter::class,
 *     properties={
 *          "caseName",
 *          "status",
 *          "createdAt",
 *          "updatedAt",
 *     }
 * )
 */
class CareCase
{
    use Timestampable;
    use Blameable;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Length(min=3, max=255)
     * @Assert\NotBlank()
     * @Groups({"carecase:read", "carecase:write"})
     */
    private $caseName;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person")
     * @ORM\JoinColumn(nullable=false, fieldName="senior_id")
     * @Groups({"carecase:read", "carecase:write"})
     */
    private $senior;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person")
     * @ORM\JoinColumn(nullable=true, fieldName="volunteer_id")
     * @Groups({"carecase:read", "carecase:write"})
     */
    private $volunteer;

    /**
     * @var string|null a description of the item
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/description")
     * @Assert\Type(type="string")
     * @Groups({"carecase:read", "carecase:write"})
     */
    private $description;

    /**
     * @var CareCaseStatus|null
     *
     * @ORM\Column(type=CareCaseStatus::class, nullable=false)
     * @ApiProperty(iri="http://schema.org/Enumeration", attributes={
     *          "jsonld_context"={
     *              "type"=CareCaseStatus::class,
     *              "enum"={"new", "assigned", "accepted", "rejected", "ongoing", "done"},
     *              "example"="new"
     *           }
     *     })
     * @Assert\Type(type=CareCaseStatus::class)
     * @Groups({"carecase:read", "carecase:write"})
     */
    private $status = CareCaseStatus::NEW;

    public function getCaseName(): ?string
    {
        return (string)$this->caseName;
    }

    public function setCaseName(string $casename): self
    {
        $this->caseName = $casename;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return CareCaseStatus
     */
    public function getStatus(): CareCaseStatus
    {
        return $this->status;
    }

    /**
     * @param CareCaseStatus|string $status
     *
     * @return CareCase
     */
    public function setStatus($status): CareCase
    {
        $this->status = $status instanceof CareCaseStatus ? $status : constant(CareCaseStatus::class . '::' . $status);

        return $this;
    }

    public function getSenior(): ?Person
    {
        return $this->senior;
    }

    public function setSenior(?Person $senior): self
    {
        $this->senior = $senior;

        return $this;
    }

    public function getVolunteer(): ?Person
    {
        return $this->volunteer;
    }

    public function setVolunteer(?Person $volunteer): self
    {
        $this->volunteer = $volunteer;

        return $this;
    }
}
