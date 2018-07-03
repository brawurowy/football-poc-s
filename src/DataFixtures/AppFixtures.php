<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Team;
use App\Entity\League;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        // create 20 users
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setUsername('testuser'.$i);
            $password = $this->encoder->encodePassword($user, 'test');
            $user->setPassword($password);
            $user->setEmail('user-football-poc-'.$i.'@test.com');
            $manager->persist($user);
        }

        // create a league
        $league = new League();
        $league->setName('Liga testowa');
        $manager->persist($league);

        // create 10 teams
        for ($i = 0; $i <10; $i++) {
            $team = new Team();
            $team->setName('Test team '.$i);
            $team->setStrip('Test strip '.$i);
            $team->setLeague($league);
            $league->addTeam($team);
            $manager->persist($team);
            $manager->persist($league);
        }

        $manager->flush();
    }
}