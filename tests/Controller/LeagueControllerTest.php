<?php

namespace App\Tests\Controller;

class LeagueControllerTest extends BaseControllerTest
{
    public function testShowTeams()
    {
        $client = $this->createAuthenticatedClient();

        $client->request('GET', '/api/v1/leagues/1/teams');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}