<?php

namespace App\Tests\Controller;

use App\Entity\League;

class LeagueControllerTest extends BaseControllerTest
{
    public function testShowTeams()
    {
        $client = $this->createAuthenticatedClient();

        $client->request('GET', '/api/v1/leagues/1/teams');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowLeague()
    {
        $client = $this->createAuthenticatedClient();

        $client->request('GET', '/api/v1/leagues/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testSaveLeagueToDatabase()
    {
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

        $league = new League();
        $league->setName('Liga testowa');

        $em->persist($league);

        $this->assertEquals('Liga testowa', $league->getName());
    }

}