<?php

namespace App\Api\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Api\Dto\Output\SimulationOutput;
use App\Api\Resource\Simulation;

final class SimulationOutputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $output = SimulationOutput::fromResource($data);

        dump($output);
        dump($data);
    
        return $output;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return SimulationOutput::class === $to && $data instanceof Simulation;
    }

}
