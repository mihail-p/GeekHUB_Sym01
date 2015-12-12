<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\TestBaseWeb;

class TeamControllerTest extends TestBaseWeb
{
    public function testTeamShowAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/team/Ukraine');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('list of PLAYERS', $crawler->filter('body')->text());
    }

    public function testFlagShowAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/flag/Iceland');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('About', $crawler->filter('body')->text());
    }

    public function testCoachShowAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'team/Northern/coach/Trinity Anderson');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('EURO 2016', $crawler->filter('body')->text());
    }
}