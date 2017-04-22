<?php

namespace NeoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertContains('{"hello":"world!"}', $client->getResponse()->getContent());
    }

    public function testHazardous()
    {
        $client = static::createClient();

        $client->request('GET', '/neo/hazardous');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function fastestndex()
    {
        $client = static::createClient();

        $client->request('GET', '/neo/fastest');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
