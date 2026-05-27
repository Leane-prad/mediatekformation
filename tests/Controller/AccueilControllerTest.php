<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of AccueilController
 *
 * @author leane
 */
class AccueilControllerTest extends WebTestCase {
    
    public function testAccesPage(){
        $client = static::createClient();
        $client->request('GET','/');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
