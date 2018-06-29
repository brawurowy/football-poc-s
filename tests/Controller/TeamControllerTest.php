<?php

namespace App\Tests\Controller;

class TeamControllerTest extends BaseControllerTest
{
    public function testCreateTeam()
    {
        $client = $this->createAuthenticatedClient();

        $client->request('POST', '/api/v1/teams', [
            'name' => 'test_50',
            'strip' => 'white',
            'league' => 1
        ]);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $data = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('success', $data);
        $this->assertEquals(true, $data['success']);
        $this->assertArrayHasKey('data', $data);
    }

    public function testUpdateTeam()
    {
        $client = $this->createAuthenticatedClient();

        $client->request('PATCH', '/api/v1/teams/1', [
            'name' => 'test_50',
            'strip' => 'white',
            'league' => 1
        ]);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $data = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('success', $data);
        $this->assertEquals(true, $data['success']);
        $this->assertArrayHasKey('data', $data);
    }
}