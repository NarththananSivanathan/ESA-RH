<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConnexionControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/entreprise/accueil');

        $this->assertResponseRedirects('/connexion');
    }
}
