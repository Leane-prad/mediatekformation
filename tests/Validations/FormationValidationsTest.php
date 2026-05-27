<?php

namespace App\Tests\Validations;

use App\Entity\Formation;
use App\Entity\Playlist;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Description of FormationValidationsTest
 *
 * @author leane
 */
class FormationValidationsTest extends KernelTestCase {

    public function getFormation(): Formation {

        $playlist = (new Playlist())
        ->setName("Playlist Test");

        return(new Formation())
        ->setTitle("Test")
                ->setPublishedAt(new DateTime("2025-12-06 17:00:02"))
                ->setVideoId("Z4yTTXka958")
                ->setPlaylist($playlist);
    }

    public function assertErrors(Formation $formation, int $nbErreursAttendues) {
        self::bootKernel();
        $validator = self::getContainer()->get(ValidatorInterface::class);
        $error = $validator->validate($formation);
        $this->assertCount($nbErreursAttendues, $error);
    }

    public function testEditValidPublishedAt() {
        $formation = $this->getFormation()->setPublishedAt(new DateTime("2025-10-17 18:00:02"));
        $this->assertErrors($formation, 0);
    }
    
    public function testEditNonValidPublishedAt() {
        $formation = $this->getFormation()->setPublishedAt(new DateTime("2026-10-17 18:00:02"));
        $this->assertErrors($formation, 1);
    }
    
    public function testAjoutNonValidPublishedAt(){
        $playlist = (new Playlist())
        ->setName("Playlist Test Ajout");

        $formation = (new Formation())
        ->setTitle("Test")
                ->setPublishedAt(new DateTime("2026-12-06 17:00:02"))
                ->setVideoId("Z4yTTXka958")
                ->setPlaylist($playlist);
        
        $this->assertErrors($formation,1);
    }
}
