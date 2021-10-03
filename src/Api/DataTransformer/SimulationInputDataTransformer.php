<?php

namespace App\Api\DataTransformer;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\Action;
use App\Entity\Dispositif;
use App\Entity\Offre;
use App\Repository\ActionRepository;
use App\Repository\DispositifRepository;
use App\Repository\OffreRepository;
use App\Api\Resource\Simulation;
use App\Api\Services\SimulationActionService;
use App\Api\Services\SimulationDispositifService;
use App\Api\Services\SimulationOffreService;
use App\Resolver\ExpressionResolver;

final class SimulationInputDataTransformer implements DataTransformerInterface
{
    private $validator;
    private $em;
    
    public function __construct(ValidatorInterface $validator, EntityManagerInterface $em)
    {
        $this->validator = $validator;
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        // Validation des données d'entrée
        $this->validator->validate($data);

        // Simulation

        $simulation = new Simulation();
        $simulation->secteur = $data->secteur;
        $simulation->variables = $data->variables;

        // Manager

        /** @var DispositifRepository */
        $dispositifRepository = $this->em->getRepository(Dispositif::class);
        /** @var ActionRepository */
        $actionRepository = $this->em->getRepository(Action::class);
        /** @var OffreRepository */
        $offreRepository = $this->em->getRepository(Offre::class);

        // Fetch

        $dispositifs = $dispositifRepository->findAllAvailable(
            $data->secteur->getId(), $data->dispositifs, $data->getZones()
        );
        $offres = $offreRepository->findAllAvailable(
            $data->dispositifs, $data->getActionsById(), $data->getZones()
        );
        $actions = $actionRepository->findAllAvailable(
            $data->secteur->getId(), $data->getActionsById()
        );

        // Bind

        // 1. Dispositifs

        foreach ($dispositifs as $item) {
            $simulation->dispositifs[] = SimulationDispositifService::fromEntity($item, $simulation);
        }

        // 2. Actions
        
        foreach ($actions as $item) {
            $inputKey = \array_search($item->getId(), $data->getActionsById());

            if ($inputKey !== false) {
                $action = SimulationActionService::fromEntity($item, $simulation);
                $action->variables = $data->actions[$inputKey]->variables;

                $simulation->actions[] = $action;
            }
        }
        
        // 3. Offres

        foreach ($offres as $offre) {
            // Actions ids
            $arrayActions = \array_map(function(Action $action) {
                return $action->getId();
            }, $offre->getActions());

            foreach ($simulation->actions as $action) {
                if (empty($arrayActions) || \in_array($action->id, $arrayActions)) {
                    $action->offres[] = SimulationOffreService::fromEntity($offre, $action);
                }
            }
        }

        // Validation des données intermédiaires

        $this->validator->validate($simulation);

        // Resolve

        foreach ($simulation->actions as $action) {
            foreach ($action->offres as $offre) {
                foreach ($offre->getAllConditions() as $condition) {
                    if ($condition->expression) {
                        $condition->expression->response = ExpressionResolver::resolve(
                            $condition->expression->expression, $offre
                        );
                    }
                }
                foreach ($offre->getAllValeurs() as $valeur) {
                    if ($valeur->condition) {
                        $valeur->condition->response = ExpressionResolver::resolve(
                            $valeur->condition->expression, $offre
                        );
                    }
                    if ($valeur->expression) {
                        $valeur->expression->response = ExpressionResolver::resolve(
                            $valeur->expression->expression, $offre
                        );
                    }
                }
            }
        }

        return $simulation;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof Simulation) {
            return false;
        }
        return Simulation::class === $to && null !== ($context['input']['class'] ?? null);
    }

}
