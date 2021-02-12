<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\CreateLogoAction;

/**
 * @ApiResource(
 *     iri="http://schema.org/MediaObject",
 *     normalizationContext={
 *         "groups"={"logo:item:read"}
 *     },
 *     collectionOperations={
 *         "get"={
 *              "normalization_context"={
 *                  "groups"={"logo:collection:read"}
 *              }
 *          },
 *         "post"={
 *             "controller"=CreateLogoAction::class,
 *             "deserialize"=false,
 *             "security"="is_granted('ROLE_ADMIN')",
 *             "validation_groups"={"Default", "create"},
 *             "openapi_context"={
 *                 "requestBody"={
 *                     "content"={
 *                         "multipart/form-data"={
 *                             "schema"={
 *                                 "type"="object",
 *                                 "properties"={
 *                                     "file"={
 *                                         "type"="string",
 *                                         "format"="binary"
 *                                     }
 *                                 }
 *                             }
 *                         }
 *                     }
 *                 }
 *             }
 *         }
 *     },
 *     itemOperations={"get"}
 * )
 * 
 * @Vich\Uploadable
 * 
 * @ORM\Entity
 * @ORM\Table(name="api_logo")
 */
class Logo
{
    /**
     * @var int
     * 
     * @Groups({
     *      "aide:item:read",
     *      "aide:collection:read"
     * })
     * 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filePath;

    /**
     * @var string|null
     * 
     * @ApiProperty(iri="http://schema.org/contentUrl")
     * 
     * @Groups({
     *      "logo:item:read",
     *      "aide:item:read",
     *      "aide:collection:read"
     * })
     */
    private $contentUrl;

    /**
     * @var File|null
     * 
     * @Assert\NotBlank(groups={"create"})
     * @Assert\File(maxSize = "25k")
     * @Assert\Image(
     *      minWidth = 80,
     *      maxWidth = 80,
     *      minHeight = 80,
     *      maxHeight = 80
     * )
     * 
     * @Vich\UploadableField(mapping="media_object", fileNameProperty="filePath")
     */
    private $file;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(?string $filePath): self
    {
        $this->filePath = $filePath;

        return $this;
    }

    public function getContentUrl(): ?string
    {
        return $this->contentUrl;
    }

    public function setContentUrl(?string $contentUrl): self
    {
        $this->contentUrl = $contentUrl;

        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): self
    {
        $this->file = $file;

        return $this;
    }
}
