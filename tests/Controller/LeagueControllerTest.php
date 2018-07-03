<?php

namespace App\Tests\Controller;

use App\Entity\League;

class LeagueControllerTest extends BaseControllerTest
{
    public function testExampleLeagueController()
    {
        $this->assertTrue(true);
    }

    public function testCreateLeague()
    {
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

        $league = new League();
        $league->setName('Liga testowa');

        $em->persist($league);

        $this->assertEquals('Liga testowa', $league->getName());
    }

    public function testDeleteLeague()
    {
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

        $league = new League();
        $league->setName('Liga testowa 2');

        $em->remove($league);
        $em->flush();

        $this->assertEquals('Liga testowa 2', $league->getName());
    }

    public function testCreateLeagueAndChangeName()
    {
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

        $league = new League();
        $league->setName('Liga testowa');

        $em->persist($league);

        $this->assertEquals('Liga testowa', $league->getName());

        $league->setName('Liga zmieniona');

        $em->persist($league);

        $this->assertEquals('Liga zmieniona', $league->getName());
    }
}