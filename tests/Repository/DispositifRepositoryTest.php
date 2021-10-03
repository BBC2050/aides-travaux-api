<?php

namespace Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\Dispositif;
use App\Repository\DispositifRepository;

class DispositifRepositoryTest extends KernelTestCase
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
        /** @var DispositifRepository */
        $repository = $this->em->getRepository(Dispositif::class);

        $dispositifs = $repository->findAllAvailable(1, [1, 2, 3], []);
        $this->assertCount(3, $dispositifs);
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
