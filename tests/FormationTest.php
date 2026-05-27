<?php

namespace App\Tests;

use App\Entity\Formation;
use DateTime;
use PHPUnit\Framework\TestCase;
/**
 * Description of FormationTest
 *
 * @author leane
 */
class FormationTest extends TestCase {
    
    public function testGetPublishedAtString(){
        $formation = new Formation();
        $formation->setPublishedAt(new DateTime("2025-12-06 17:00:12"));
        $this->assertEquals("06/12/2025",$formation->getPublishedAtString());
    }
}
