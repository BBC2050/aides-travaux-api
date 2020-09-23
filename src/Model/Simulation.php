<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Data\Variables;

/**
 * @ApiResource(
 *      normalizationContext={
 *          "groups"={"simulation:item:read", "simulation:offre:item:read"}
 *      },
 *      denormalizationContext={
 *          "groups"={"simulation:item:write"}
 *      },
 *      itemOperations={"get"},
 *      collectionOperations={"post"}
 * )
 */
class Simulation extends Requete
{
    use \App\Traits\SimulationTrait;

    /**
     * @var int
     * 
     * @ApiProperty(identifier=true)
     */
    private $id = 1;

    /**
     * @var string
     * 
     * @Groups({"simulation:item:read", "simulation:item:write"})
     * @Assert\NotBlank
     * @Assert\Choice(choices=Variables::CODES_REGION)
     */
    private $codeRegion;

    /**
     * @var string
     * 
     * @Groups({"simulation:item:read", "simulation:item:write"})
     * @Assert\NotBlank
     * @Assert\Choice(choices=Variables::CODES_DEPARTEMENT)
     */
    private $codeDepartement;

    /**
     * @var string
     * 
     * @Groups({"simulation:item:read", "simulation:item:write"})
     * @Assert\Type("string")
     * @Assert\Length(min = 5, max = 5)
     */
    private $codeCommune;

    /**
     * @var int
     * 
     * @Groups({"simulation:item:read", "simulation:item:write"})
     * @Assert\NotBlank
     * @Assert\Type("integer")
     * @Assert\Positive
     */
    private $compositionFoyer;

    /**
     * @var int
     * 
     * @Groups({"simulation:item:read", "simulation:item:write"})
     * @Assert\NotBlank
     * @Assert\Type("integer")
     * @Assert\Positive
     */
    private $revenusFoyer;

    /**
     * @var string
     * 
     * @Groups({"simulation:item:read", "simulation:item:write"})
     * @Assert\NotBlank
     * @Assert\Choice(choices=Variables::CODES_TYPE_PARTIE)
     */
    private $codeTypePartie = 'PRIVATIVE';

    /**
     * @var string
     * 
     * @Groups({"simulation:item:read", "simulation:item:write"})
     * @Assert\NotBlank
     * @Assert\Choice(choices=Variables::CODES_TYPE_LOGEMENT)
     */
    private $codeTypeLogement = 'MAISON';

    /**
     * @var int
     * 
     * @Groups({"simulation:item:read", "simulation:item:write"})
     * @Assert\NotBlank
     * @Assert\Positive
     */
    private $surfaceHabitable;

    /**
     * @var int
     * 
     * @Groups({"simulation:item:read", "simulation:item:write"})
     * @Assert\NotBlank
     * @Assert\Type("integer")
     * @Assert\Positive
     */
    private $ageLogement;

    /**
     * @var int
     * 
     * @Groups({"simulation:item:read", "simulation:item:write"})
     * @Assert\NotBlank
     * @Assert\Type("integer")
     * @Assert\Positive
     */
    private $nombreLogements = 1;

    /**
     * @var string
     * 
     * @Groups({"simulation:item:read", "simulation:item:write"})
     * @Assert\NotBlank
     * @Assert\Choice(choices=Variables::CODES_ENERGIE_CHAUFFAGE)
     */
    private $codeEnergieChauffage;

    /**
     * @var string
     * 
     * @Groups({"simulation:item:read", "simulation:item:write"})
     * @Assert\NotBlank
     * @Assert\Choice(choices=Variables::CODES_TYPE_CHAUFFAGE)
     */
    private $codeTypeChauffage;

    /**
     * @var string
     * 
     * @Groups({"simulation:item:read", "simulation:item:write"})
     * @Assert\NotBlank
     * @Assert\Choice(choices=Variables::CODES_STATUT)
     */
    private $codeStatut;

    /**
     * @var string
     * 
     * @Groups({"simulation:item:read", "simulation:item:write"})
     * @Assert\NotBlank
     * @Assert\Choice(choices=Variables::CODES_OCCUPATION)
     */
    private $codeOccupation;

    public function getId(): int
    {
        return 1;
    }

    public function getCodeRegion(): ?string
    {
        return $this->codeRegion;
    }

    public function setCodeRegion(?string $codeRegion): self
    {
        $this->codeRegion = $codeRegion;

        return $this;
    }

    public function getCodeDepartement(): ?string
    {
        return $this->codeDepartement;
    }

    public function setCodeDepartement(?string $codeDepartement): self
    {
        $this->codeDepartement = $codeDepartement;

        return $this;
    }

    public function getCodeCommune(): ?string
    {
        return $this->codeCommune;
    }

    public function setCodeCommune(?string $codeCommune): self
    {
        $this->codeCommune = $codeCommune;

        return $this;
    }

    public function getCompositionFoyer(): ?int
    {
        return $this->compositionFoyer;
    }

    public function setCompositionFoyer(?int $compositionFoyer): self
    {
        $this->compositionFoyer = $compositionFoyer;

        return $this;
    }

    public function getRevenusFoyer(): ?int
    {
        return $this->revenusFoyer;
    }

    public function setRevenusFoyer(?int $revenusFoyer): self
    {
        $this->revenusFoyer = $revenusFoyer;

        return $this;
    }

    public function getCodeTypePartie(): ?string
    {
        return $this->codeTypePartie;
    }

    public function setCodeTypePartie(?string $codeTypePartie): self
    {
        $this->codeTypePartie = $codeTypePartie;

        return $this;
    }

    public function getCodeTypeLogement(): ?string
    {
        return $this->codeTypeLogement;
    }

    public function setCodeTypeLogement(?string $codeTypeLogement): self
    {
        $this->codeTypeLogement = $codeTypeLogement;

        return $this;
    }

    public function getSurfaceHabitable(): ?int
    {
        return $this->surfaceHabitable;
    }

    public function setSurfaceHabitable(?int $surfaceHabitable): self
    {
        $this->surfaceHabitable = $surfaceHabitable;

        return $this;
    }

    public function getAgeLogement(): ?int
    {
        return $this->ageLogement;
    }

    public function setAgeLogement(?int $ageLogement): self
    {
        $this->ageLogement = $ageLogement;

        return $this;
    }

    public function getNombreLogements(): ?int
    {
        return $this->nombreLogements;
    }

    public function setNombreLogements(?int $nombreLogements): self
    {
        $this->nombreLogements = $nombreLogements;

        return $this;
    }

    public function getCodeEnergieChauffage(): ?string
    {
        return $this->codeEnergieChauffage;
    }

    public function setCodeEnergieChauffage(?string $codeEnergieChauffage): self
    {
        $this->codeEnergieChauffage = $codeEnergieChauffage;

        return $this;
    }

    public function getCodeTypeChauffage(): ?string
    {
        return $this->codeTypeChauffage;
    }

    public function setCodeTypeChauffage(?string $codeTypeChauffage): self
    {
        $this->codeTypeChauffage = $codeTypeChauffage;

        return $this;
    }

    public function getCodeStatut(): ?string
    {
        return $this->codeStatut;
    }

    public function setCodeStatut(?string $codeStatut): self
    {
        $this->codeStatut = $codeStatut;

        return $this;
    }

    public function getCodeOccupation(): ?string
    {
        return $this->codeOccupation;
    }

    public function setCodeOccupation(?string $codeOccupation): self
    {
        $this->codeOccupation = $codeOccupation;

        return $this;
    }

    public function __call(string $name, array $arguments)
    {
        return null;
    }

}
