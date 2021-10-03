<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Utilisateur;

class UtilisateurFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $hasher;

    /**
     * @var array
     */
    const USERS = [ 
        [ 'EMAIL' => 'admin@test.com', 'ROLES' => ['ROLE_ADMIN'] ],
        [ 'EMAIL' => 'superadmin@test.com', 'ROLES' => ['ROLE_SUPER_ADMIN'] ],
    ];

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::USERS as $item) {
            $user = (new Utilisateur())
                ->setEmail($item['EMAIL'])
                ->setRoles($item['ROLES']);

            $user->setPassword(
                $this->hasher->hashPassword($user, $item['EMAIL'])
            );
            $manager->persist($user);
        }
        $manager->flush();
    }

}
