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

    public function testShowTeam()
    {
        $client = $this->createAuthenticatedClient();

        $client->request('GET', '/api/v1/leagues/1/teams/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testUpdateLeague()
    {
        $client = $this->createAuthenticatedClient();

        $client->request('PATCH', '/api/v1/leagues/1', [
            'name' => 'league_test_50'
        ]);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $data = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('success', $data);
        $this->assertEquals(true, $data['success']);
        $this->assertArrayHasKey('data', $data);
    }

    public function testDeleteLeague()
    {
        $client = $this->createAuthenticatedClient();

        $client->request('DELETE', '/api/v1/leagues/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $data = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('success', $data);
        $this->assertEquals(true, $data['success']);
        $this->assertArrayHasKey('data', $data);
    }
}