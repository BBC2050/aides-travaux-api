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

    public function testFindByOuvragesAndAides()
    {
        /** @var OffreRepository */
        $repository = $this->em->getRepository(Offre::class);

        $offres = $repository->findByOuvragesAndAides(
            [27], [1, 2, 3, 4, 5, 7, 8]
        );

        $this->assertCount(5, $offres);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
    }
}
