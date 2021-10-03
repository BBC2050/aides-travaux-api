<?php

namespace App\Api\Dto\Input;

use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Secteur;
use App\Services\Geo\FranceMetropolitaineService;

class SimulationInput
{
    /**
     * Secteur d'application
     * 
     * @Assert\NotBlank
     */
    public ?Secteur $secteur = null;

    /**
     * Liste des identifiants des dispositifs
     * 
     * @Assert\NotNull
     * @Assert\Type("array")
     * @Assert\Count(min = 1)
     * @Assert\All({
     *      @Assert\NotBlank,
     *      @Assert\Type("int"),
     *      @Assert\Positive
     * })
     */
    public ?array $dispositifs = [];

    /**
     * Liste des données d'entrée relatives aux actions
     * 
     * @var SimulationActionInput[]|array
     * 
     * @Assert\NotNull
     * @Assert\Type("array")
     * @Assert\Count(min = 1)
     * @Assert\Valid
     */
    public ?array $actions = [];

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Regex("/^\d{5,5}$/")
     */
    public ?string $codePostal = null;

    /**
     * @Assert\NotBlank,
     * @Assert\Type("string"),
     * @Assert\AtLeastOneOf(
     *      @Assert\Regex("/^\d*$/"),
     *      @Assert\Choice({"2A", "2B"})
     * )
     */
    public ?string $codeDepartement = null;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Regex("/^\d{2,2}$/")
     */
    public ?string $codeRegion = null;

    /**
     * Liste des données d'entrée
     * 
     * @Assert\NotNull
     * @Assert\Type("array")
     * @Assert\All({
     *      @Assert\AtLeastOneOf({
     *          @Assert\Type("string"),
     *          @Assert\Type("int"),
     *          @Assert\Type("float"),
     *          @Assert\Type("bool")
     *      })
     * })
     */
    public ?array $variables = [];

    /**
     * Retourne le code ISO de la France métropolitaine
     */
    public function getCodeISO(): ?string
    {
        return $this->codeRegion && FranceMetropolitaineService::get($this->codeRegion)
            ? FranceMetropolitaineService::CODE_ISO
            : null;
    }

    /**
     * Retourne un tableau des codes géographiques de la simulation
     */
    public function getZones(): array
    {
        $zones = [];

        if ($this->codePostal) {
            $zones[] = $this->codePostal;
        }
        if ($this->codeDepartement) {
            $zones[] = $this->codeDepartement;
        }
        if ($this->codeRegion) {
            $zones[] = $this->codeRegion;
        }
        if ($this->getCodeISO()) {
            $zones[] = $this->getCodeISO();
        }
        return $zones;
    }

    /**
     * Retourne la liste des actions par IDs
     */
    public function getActionsById(): array
    {
        if ($this->actions === null) {
            return [];
        }
        return \array_map(function(SimulationActionInput $item) {
            return $item->id;
        }, $this->actions);
    }

}
