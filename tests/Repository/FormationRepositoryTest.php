<?php

namespace App\Tests\Repository;

use App\Entity\Formation;
use App\Entity\Playlist;
use App\Repository\FormationRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of FormationRepositoryTest
 *
 * @author leane
 */
class FormationRepositoryTest extends KernelTestCase {
    
    public function recupRepository() : FormationRepository{
        self::bootKernel();
        $repository= self::getContainer()->get(FormationRepository::class);
        return $repository;
    }
    
    public function newFormation() : Formation{
        $entityManager = self::getContainer()->get(EntityManagerInterface::class);
        $playlist = $entityManager->getRepository(Playlist::class)->findOneBy(['name' => 'Eclipse et Java']);
        

        $formation = (new Formation())
        ->setTitle("Formation Test Repository")
                ->setPublishedAt(new DateTime("2025-12-06 17:00:02"))
                ->setVideoId("Z4yTTXka958")
                ->setPlaylist($playlist);
        
        return $formation;
    }
    
    public function testAddFormation() {
        $repository = $this->recupRepository();
        $formation = $this->newFormation();
        $nbVisites = $repository->count([]);
        $repository->add($formation,true);
        $this->assertEquals($nbVisites + 1,$repository->count([]),"erreur lors de l'ajout");
    }
    
    public function testRemoveFormation(){
        $repository = $this->recupRepository();
        $formation = $this->newFormation();
        $repository->add($formation,true);
        $nbVisites = $repository->count([]);
        $repository->remove($formation,true);
        $this->assertEquals($nbVisites - 1,$repository->count([]),"erreur lors de la suppression");
    }
}
