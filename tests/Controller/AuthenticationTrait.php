<?php

namespace App\Tests\Controller;

use App\Repository\UtilisateurRepository;

trait AuthenticationTrait
{
    public static function authorization($superAdmin = false): array
    {
        $userRepository = static::$container->get(UtilisateurRepository::class);
        $user = $userRepository->find($superAdmin ? 3 : 2);

        return [ 'API_KEY' => $user->getUuid() ];
    }
}
