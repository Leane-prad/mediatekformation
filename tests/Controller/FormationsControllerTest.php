<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Description of FormationsController
 *
 * @author leane
 */
class FormationsControllerTest extends WebTestCase {

    public function testFiltreFormation() {
        $client = static::createClient();
        $client->request('GET', '/formations');
        $crawler = $client->submitForm('filtrer', [
            'recherche' => 'C# : ListBox en couleur'
        ]);

        $this->assertCount(1, $crawler->filter('h5'));
        $this->assertSelectorTextContains('h5', 'C# : ListBox en couleur');
    }

    public function testFiltrePlaylist() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/formations');
        $form = $crawler->filter('#playlist')->form([
            'recherche' => 'Bases de la programmation (C#)'
        ]);
        $crawler = $client->submit($form);

        $nbformations = $crawler->filter('h5')->count();
        $this->assertGreaterThanOrEqual(74, $nbformations);
        $this->assertSelectorTextContains('h5', 'Bases de la programmation n°74 - POO : collections');
    }

    public function testFiltreCategorie() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/formations');

        $form = $crawler->filter('#categorie')->form([
            'recherche' => '2'
        ]);
        $crawler = $client->submit($form);
        $this->assertGreaterThanOrEqual(11, $crawler->filter('h5')->count());
        $this->assertSelectorTextContains('h5', 'Eclipse n°2 : rétroconception avec ObjectAid');
    }

    public function testTriFormationCroissant() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/formations/tri/title/ASC');
        $firstFormation = $crawler->filter('h5')->first()->text();
        $this->assertSame('Android Studio (complément n°1) : Navigation Drawer et Fragment', $firstFormation);
    }
    
    public function testTriPlaylistDecroissant() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/formations/tri/name/DESC/playlist');
        $firstFormation = $crawler->filter('h5')->first()->text();
        $this->assertSame('C# : ListBox en couleur', $firstFormation);
    }
    
    public function testTriDateCroissant(){
        $client = static::createClient();
        $crawler = $client->request('GET', '/formations/tri/publishedAt/ASC');
        $firstFormation = $crawler->filter('h5')->first()->text();
        $this->assertSame('Cours UML (1 à 7 / 33) : introduction et cas d\'utilisation',$firstFormation);
    }
}
