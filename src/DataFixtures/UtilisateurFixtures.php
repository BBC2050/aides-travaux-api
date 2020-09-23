<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UtilisateurFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * @var array
     */
    const USERS = [ 
        [ 'EMAIL' => 'user@test.com', 'ROLES' => ['ROLE_USER'] ],
        [ 'EMAIL' => 'admin@test.com', 'ROLES' => ['ROLE_ADMIN'] ],
        [ 'EMAIL' => 'superadmin@test.com', 'ROLES' => ['ROLE_SUPER_ADMIN'] ],
    ];

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::USERS as $user) {
            $user = (new \App\Entity\Utilisateur())
                ->setEmail($user['EMAIL'])
                ->setRoles($user['ROLES']);
            $user->setPassword(
                $this->encoder->encodePassword($user, 'utilisateurtest')
            );
            $manager->persist($user);
        }
        $manager->flush();
    }
}
