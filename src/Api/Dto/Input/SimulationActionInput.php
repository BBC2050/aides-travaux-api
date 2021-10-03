<?php

namespace App\Api\Dto\Input;

use Symfony\Component\Validator\Constraints as Assert;

class SimulationActionInput
{
    /**
     * Identifiant de l'action
     * 
     * @Assert\NotBlank
     * @Assert\Type("int")
     * @Assert\Positive
     */
    public ?int $id = null;

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

}
