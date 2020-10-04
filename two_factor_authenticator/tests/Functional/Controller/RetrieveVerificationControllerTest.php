<?php

namespace App\Functional\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class RetrieveVerificationControllerTest extends WebTestCase
{

    protected function setUp(): void {
        exec('bin/console doctrine:migrations:migrate -n --env=test');
        parent::setUp();
    }
    /**
     * @test
     */
    public function itShouldReturnTheVerificationInfo()
    {

        $client = static::createClient();
        $client->request(
            'POST',
            '/verifications',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"phoneNumber":"611 11 11 11"}'
        );

        $content = json_decode($client->getResponse()->getContent());

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client->request(
            'POST',
            "/verifications/".$content->verificationId,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"code":"'.$content->code.'"}'
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $content = json_decode($client->getResponse()->getContent());

        $this->assertTrue($content);
    }

    protected function tearDown(): void
    {
        exec('bin/console doctrine:database:drop --force --env=test');
        parent::tearDown();
    }
}
