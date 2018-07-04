<?php

namespace App\Tests\Controller;

use App\Entity\Team;
use App\Entity\League;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

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

    public function testDeleteTeam()
    {
        $client = $this->createAuthenticatedClient();

        $client->request('DELETE', '/api/v1/teams/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $data = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('success', $data);
        $this->assertEquals(true, $data['success']);
        $this->assertArrayHasKey('data', $data);
    }

    public function testUpdateResponseIsJson()
    {
        $client = $this->createAuthenticatedClient();

        $client->request('PATCH', '/api/v1/teams/1', [
            'name' => 'test_50',
            'strip' => 'white',
            'league' => 1
        ]);
        $this->assertTrue($client->getResponse()->headers->contains(
            'Content-Type',
            'application/json'
        ),
            'the "Content-Type" header is "application/json"'
        );
    }

    public function testDeleteResponseIsJson()
    {
        $client = $this->createAuthenticatedClient();

        $client->request('DELETE', '/api/v1/teams/1');
        $this->assertTrue($client->getResponse()->headers->contains(
            'Content-Type',
            'application/json'
        ),
        'the "Content-Type" header is "application/json"'
            );
    }

    public function testSaveTeamToDatabase()
    {
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

        $league = new League();
        $league->setName('Liga testowa');

        $team = new Team();
        $team->setName('Test team');
        $team->setStrip('Test strip');
        $team->setLeague($league);
        $league->addTeam($team);
        $em->persist($team);
        $em->persist($league);

        $this->assertEquals('Test team', $team->getName());
        $this->assertEquals('Test strip', $team->getStrip());
    }
}