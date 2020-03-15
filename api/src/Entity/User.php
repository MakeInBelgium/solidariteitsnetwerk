<?php
/**
 * solidariteitsnetwerk: User.php
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use App\Filter\MultiSearchFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\User\UserPostCollectionController;
use App\Controller\User\UserPutItemController;
use App\Controller\DashboardAction;
use App\Entity\Traits\Blameable;
use App\Entity\Traits\IsActive;
use App\Entity\Traits\Timestampable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="`user`")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("username", errorPath="username", groups={"user:write"})
 * @UniqueEntity("email", errorPath="email", groups={"user:write"})
 * @ApiResource(
 *     normalizationContext={"groups"={"read", "user:read"}},
 *     denormalizationContext={"groups"={"write", "user:write"}},
 *     security="is_granted('ROLE_ADMIN')",
 *     attributes={
 *          "order"={"username": "ASC"}
 *     },
 *     collectionOperations={
 *          "get"={"security"="is_granted('ROLE_ADMIN')"},
 *          "post"={
 *              "security"="is_granted('ROLE_SUPERADMIN')",
 *              "validation_groups"={"Default", "create"},
 *              "normalization_context"={"groups"={"user:write", "user:collection:post"}},
 *              "denormalization_context"={"groups"={"user:write", "user:collection:post"}},
 *              "controller"=UserPostCollectionController::class,
 *          },
 *          "dashboard"={
 *              "security"="is_granted('ROLE_STAFF')",
 *              "method"="GET",
 *              "path"="/users/dashboard",
 *              "controller"=DashboardAction::class,
 *              "defaults"={"_api_receive"=false, "_api_respond"=false},
 *          },
 *     },
 *     itemOperations={
 *          "get",
 *          "put"={
 *              "security"="(is_granted('ROLE_ADMIN') and object == user) or is_granted('edit', object)",
 *              "validation_groups"={"Default", "edit"},
 *              "controller"=UserPutItemController::class,
 *          },
 *          "delete"={"security"="is_granted('ROLE_SUPERADMIN')"}
 *     }
 * )
 * @ApiFilter(DateFilter::class, properties={"createdAt", "updatedAt"})
 * @ApiFilter(
 *     MultiSearchFilter::class, properties={
 *         "name": {"firstName", "lastName"}
 *     }
 * )
 * @ApiFilter(
 *     OrderFilter::class,
 *     properties={
 *          "name",
 *          "updatedAt",
 *     }
 * )
 */
class User implements UserInterface
{
    use Timestampable;
    use Blameable;

    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_STAFF = 'ROLE_STAFF';
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_SUPERADMIN = 'ROLE_SUPERADMIN';

    public const DEFAULT_ROLES = [self::ROLE_USER];

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
     * @Groups({"user:read", "user:write"})
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user:read", "user:write"})
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"user:read", "user:write"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=128)
     * @Groups({"user:read", "user:write"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="json")
     * @Groups({"admin:read", "admin:write", "user:write"})
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @Groups({"owner:write", "admin:write", "user:collection:post", "user:write"})
     * @SerializedName("password")
     * @Assert\NotBlank(allowNull=true, groups={"create", "edit"})
     */
    private $plainPassword;


    public function getUsername(): ?string
    {
        return (string)$this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return $this->roles;
        // guarantee every user at least has ROLE_USER
        // $roles[] = static::DEFAULT_ROLES[0];

        // return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string)$this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @ApiProperty(iri="http://schema.org/name")
     * @Groups({"user:read"})
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->__toString();
    }

    public function __toString()
    {
        return sprintf('%s %s', $this->firstName, $this->lastName);
    }
}
