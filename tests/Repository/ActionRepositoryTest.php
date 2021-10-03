<?php

namespace Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\Action;
use App\Repository\ActionRepository;

class ActionRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->em = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testFindAllAvailable(): void
    {
        /** @var ActionRepository */
        $repository = $this->em->getRepository(Action::class);

        $offres = $repository->findAllAvailable(1, [1, 2, 3]);
        $this->assertCount(3, $offres);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }

}
