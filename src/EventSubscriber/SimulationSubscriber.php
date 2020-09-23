<?php

namespace App\EventSubscriber;

use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use App\Entity\Aide;
use App\Entity\Ouvrage;
use App\Model\Simulation;

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
                [ 'fetchOuvrages', EventPriorities::POST_WRITE ],
                [ 'run', EventPriorities::POST_WRITE ]
            ]
        ];
    }

    public function fetchOuvrages(ViewEvent $event): void
    {
        $simulation = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$simulation instanceof Simulation || Request::METHOD_POST !== $method) {
            return;
        }

        $aides = $simulation->getAides()->map(function($aide) {
            return $aide->getId();
        });

        foreach ($simulation->getOuvrages() as $ouvrage) {
            $ressource = $this->em->getRepository(Ouvrage::class)->findOneByAides(
                $ouvrage->getId(), $aides->getValues()
            );
            $ouvrage->setRessource($ressource);
        }
    }

    public function run(ViewEvent $event): void
    {
        $simulation = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$simulation instanceof Simulation || Request::METHOD_POST !== $method) {
            return;
        }

        foreach ($simulation->getAides() as $aide) {
            $aide->resolveConditions();
            $aide->resolveValeursConditions();
            $aide->resolveValeurs();
        }
        foreach ($simulation->getOuvrages() as $ouvrage) {
            foreach ($ouvrage->getRessource()->getOffres() as $offre) {
                $offre->resolveConditions();
                $offre->resolveValeursConditions();
                $offre->resolveValeurs();
            }
        }
        dump($simulation);
    }
}