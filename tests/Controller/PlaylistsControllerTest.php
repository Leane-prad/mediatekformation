<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of PlaylistsController
 *
 * @author leane
 */
class PlaylistsControllerTest extends WebTestCase {

    public function testFiltrePlaylist() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/playlists');
        $form = $crawler->filter('#playlist')->form([
            'recherche' => 'Cours UML'
        ]);
        $crawler = $client->submit($form);
        $this->assertCount(1, $crawler->filter('h5'));
        $this->assertSelectorTextContains('h5', 'Cours UML');
    }

    public function testLinkPlaylist() {
        $client = static::createClient();
        $client->request('GET', '/playlists');
        $client->clickLink('Voir détail');
        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testContenuPagePlaylist() {
        $client = static::createClient();
        $client->request('GET', '/playlists/playlist/24');
        $this->assertSelectorTextContains('h4', 'Cours UML');
    }
    
    public function testTriPlaylistDecroissant() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/playlists/tri/name/DESC');
        $firstPlaylist = $crawler->filter('h5')->first()->text();
        $this->assertSame('Visual Studio 2019 et C#', $firstPlaylist);
    }
    
     public function testTriNbFormationCroissant() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/playlists/tri/nbFormations/ASC');
        $firstPlaylist = $crawler->filter('h5')->first()->text();
        $this->assertSame('playlist test', $firstPlaylist);
    }
}
