<?php

namespace App\Tests\Controller;

use App\Entity\Team;
use App\Entity\League;

class TeamControllerTest extends BaseControllerTest
{
    public function testCreateTeam()
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

    public function testDeleteTeam()
    {
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

        $league = new League();
        $league->setName('Liga testowa 2');

        $team = new Team();
        $team->setName('Deleted team');
        $team->setStrip('Test strip');
        $team->setLeague($league);
        $league->addTeam($team);

        $em->remove($team);
        $em->remove($league);
        $em->flush();

        $this->assertEquals('Deleted team', $team->getName());
        $this->assertEquals('Liga testowa 2', $league->getName());
    }
}