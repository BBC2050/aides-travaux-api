<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use App\Entity\Utilisateur;

final class UtilisateurSubscriber implements EventSubscriberInterface
{
    /**
     * @var UserPasswordHasherInterface
     */
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [ 'setPassword', EventPriorities::POST_VALIDATE ],
        ];
    }

    public function setPassword(ViewEvent $event): void
    {
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$user instanceof Utilisateur || Request::METHOD_POST !== $method) {
            return;
        }

        $user->setPassword($this->hasher->hashPassword(
            $user, $user->getPlainPassword()
        ));
    }

}
