<?php

namespace App\Tests\Repository;

use App\Repository\PlaylistRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of PlaylistRepositoryTest
 *
 * @author leane
 */
class PlaylistRepositoryTest extends KernelTestCase {

    public function recupRepository(): PlaylistRepository {
        self::bootKernel();
        $repository = self::getContainer()->get(PlaylistRepository::class);
        return $repository;
    }

    public function testfindAllOrderByNbFormationsASC() {
        $repository = $this->recupRepository();
        $result = $repository->findAllOrderByNbFormations('ASC');
        $first = $result[0];
        $last = $result[count($result) - 1];

        $this->assertLessThanOrEqual(
                count($last->getFormations()),
                count($first->getFormations())
        );
    }
    
    public function testfindAllOrderByNbFormationsDESC() {
        $repository = $this->recupRepository();
        $result = $repository->findAllOrderByNbFormations('DESC');

        $this->assertGreaterThanOrEqual(28,count($result));

        $first = $result[0];
        $second = $result[1];

        $this->assertGreaterThanOrEqual(
                count($second->getFormations()),
                count($first->getFormations())
        );
    }
}
