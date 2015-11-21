<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TeamControllerTest extends WebTestCase
{
    public function testteamShowAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/team/Ukraine');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('player10', $crawler->filter('body')->text());
    }

    public function testflagShowAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/flag/Iceland');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('amet', $crawler->filter('body')->text());
    }

    public function testcoachShowAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'team/Northern/coach/coach3');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('dolor', $crawler->filter('body')->text());
    }
}