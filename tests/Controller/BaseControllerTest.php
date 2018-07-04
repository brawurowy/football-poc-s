<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BaseControllerTest extends WebTestCase
{
    /**
     * Create a client with a default Authorization header.
     *
     * @param string $username
     * @param string $password
     *
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
    protected function createAuthenticatedClient($username = 'testuser0', $password = 'test')
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/login_check',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"username":"'.$username.'","password":"'.$password.'"}'

        );

        $data = json_decode($client->getResponse()->getContent(), true);
        $client = static::createClient();
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }

    public function testClientAuthenticated()
    {
        $client = $this->createAuthenticatedClient();

        $this->assertTrue($client != null);
    }
}