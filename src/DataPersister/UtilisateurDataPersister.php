<?php

namespace App\DataPersister;

use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Utilisateur;

final class UtilisateurrDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $this->em = $em;
        $this->encoder = $encoder;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Utilisateur;
    }

    public function persist($data, array $context = [])
    {        
        if ($data->getPlainPassword()) {
            $data->setPassword(
                $this->encoder->encodePassword( $data, $data->getPlainPassword() )
            );
        }
        $this->em->persist($data);
        $this->em->flush();
    }

    public function remove($data, array $context = [])
    {
        $this->em->remove($data);
        $this->em->flush();
    }
}
