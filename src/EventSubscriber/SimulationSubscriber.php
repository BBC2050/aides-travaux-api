<?php

namespace App\EventSubscriber;

use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use App\Entity\Offre;
use App\Entity\Simulation;
use App\Resolver\ExpressionResolver;

final class SimulationSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [
                [ 'fetchOffres', EventPriorities::POST_WRITE ],
                [ 'resolve', EventPriorities::POST_WRITE ]
            ]
        ];
    }

    public function fetchOffres(ViewEvent $event): void
    {
        $simulation = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$simulation instanceof Simulation || Request::METHOD_POST !== $method) {
            return;
        }
        /** @var \App\Repository\OffreRepository */
        $repository = $this->em->getRepository(Offre::class);

        /** @var array offres disponibles */
        $offres = $repository->findByOuvragesAndAides(
            $simulation->getOuvrages()->map(function($ouvrage) {
                return $ouvrage->getOuvrage()->getId();
            })->toArray(),
            $simulation->getAides()->map(function($aide) {
                return $aide->getAide()->getId();
            })->toArray()
        );

        foreach ($offres as $offre) {
            /** @var array IDs des ouvrages éligibles à l'offre */
            $ouvrages = $offre->getOuvrages()->map(function($ouvrage) {
                return $ouvrage->getId();
            })->toArray();

            foreach ($simulation->getOuvrages() as $ouvrage) {
                if (\in_array($ouvrage->getOuvrage()->getId(), $ouvrages)) {
                    $ouvrage->addOffre($offre);
                }
            }
        }
    }

    public function resolve(ViewEvent $event): void
    {
        $simulation = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$simulation instanceof Simulation || Request::METHOD_POST !== $method) {
            return;
        }

        foreach ($simulation->getOuvrages() as $ouvrage) {
            foreach ($ouvrage->getOffres() as $offre) {
                // Résolution des conditions propres à l'offre
                foreach ($offre->getConditions() as $condition) {
                    foreach ($condition->getExpressions() as $expression) {
                        ExpressionResolver::resolve($expression, $offre);
                    }
                }
                // Résolution des valeurs propres à l'offre
                foreach ($offre->getValeurs() as $valeur) {
                    ExpressionResolver::resolve($valeur->getExpression(), $offre);

                    foreach ($valeur->getConditions() as $condition) {
                        foreach ($condition->getExpressions() as $expression) {
                            ExpressionResolver::resolve($expression, $offre);
                        }
                    }
                }
                // Résolution des conditions propres à l'aide
                foreach ($offre->getAide()->getConditions() as $condition) {
                    foreach ($condition->getExpressions() as $expression) {
                        if ($expression->getResponse() === null) {
                            ExpressionResolver::resolve($expression, $offre);
                        }
                    }
                }
                // Résolution des valeurs propres à l'aide
                foreach ($offre->getAide()->getValeurs() as $valeur) {
                    if ($valeur->getExpression()->getResponse() === null) {
                        ExpressionResolver::resolve($valeur->getExpression(), $offre);
                    }
                    
                    foreach ($valeur->getConditions() as $condition) {
                        foreach ($condition->getExpressions() as $expression) {
                            if ($expression->getResponse() === null) {
                                ExpressionResolver::resolve($expression, $offre);
                            }
                        }
                    }
                }
            }
        }
    }
}
