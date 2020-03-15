<?php
/**
 * solidariteitsnetwerk: MediaObject.php
 *
 * @author Koen Van den Wijngaert <koen@neok.be>
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\CreateMediaObjectAction;
use App\Entity\Traits\Blameable;
use App\Entity\Traits\IsActive;
use App\Entity\Traits\Timestampable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @ApiResource(
 *     iri="http://schema.org/MediaObject",
 *     attributes={
 *         "order"={"updatedAt": "DESC"},
 *         "formats"={"json", "jsonld", "form"={"multipart/form-data"}}
 *     },
 *     normalizationContext={
 *         "groups"={"read", "media_object_read", "mediaobject:read"},
 *     },
 *     denormalizationContext={
 *         "groups"={"media_object_write", "mediaobject:write"},
 *     },
 *     collectionOperations={
 *         "post"={
 *             "controller"=CreateMediaObjectAction::class,
 *             "deserialize"=false,
 *             "access_control"="is_granted('ROLE_STAFF')",
 *             "validation_groups"={"Default", "media_object_create"},
 *             "swagger_context"={
 *                 "consumes"={
 *                     "multipart/form-data",
 *                 },
 *                 "parameters"={
 *                     {
 *                         "in"="formData",
 *                         "name"="file",
 *                         "type"="file",
 *                         "description"="The file to upload",
 *                     },
 *                 },
 *             },
 *         },
 *         "get",
 *     },
 *     itemOperations={
 *         "get",
 *     },
 * )
 * @Vich\Uploadable
 */
class MediaObject
{
    use Timestampable;
    use Blameable;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     */
    protected $id;

    /**
     * @var string|null
     *
     * @ApiProperty(iri="http://schema.org/contentUrl")
     * @Groups({"mediaobject:read"})
     */
    public $contentUrl;

    /**
     * @var File|null
     *
     * @Assert\NotNull(groups={"media_object_create"})
     * @Assert\File(groups={"media_object_create"})
     * @Vich\UploadableField(mapping="media_object", fileNameProperty="filePath", size="size", dimensions="dimensions", mimeType="mimeType")
     */
    public $file;

    /**
     * @var string|null
     *
     * @ORM\Column(nullable=true)
     * @ApiProperty()
     */
    public $filePath;

    /**
     * @var string|null
     *
     * @ORM\Column(nullable=true)
     */
    public $directory = 'default';

    /**
     * @ORM\Column(name="mime_type", nullable=true)
     * @ApiProperty()
     * @Groups({"mediaobject:read"})
     */
    public $mimeType;

    /**
     * @ORM\Column(name="size", type="integer", nullable=true)
     * @ApiProperty()
     * @Groups({"mediaobject:read"})
     */
    public $size;

    /**
     * @ORM\Column(name="dimensions", type="simple_array", nullable=true)
     * @ApiProperty()
     * @Groups({"mediaobject:read"})
     */
    public $dimensions;

    /**
     * @var string|null
     *
     * @ApiProperty()
     * @Groups({"mediaobject:read"})
     */
    public $thumbnails = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ApiProperty(iri="http://schema.org/name")
     * @Groups({"mediaobject:read"})
     * @return string
     */
    public function getRelativePath(): string {
        return sprintf('%s/%s', $this->directory, $this->filePath);
    }
}
