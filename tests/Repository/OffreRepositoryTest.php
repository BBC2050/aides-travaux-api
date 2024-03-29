<?php

namespace Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\Offre;
use App\Repository\OffreRepository;

class OffreRepositoryTest extends KernelTestCase
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
        /** @var OffreRepository */
        $repository = $this->em->getRepository(Offre::class);

        $offres = $repository->findAllAvailable([1, 2, 3], [1, 2], []);
        $this->assertCount(20, $offres);
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
