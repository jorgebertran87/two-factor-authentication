<?php

namespace App\Functional\Tests\Controller;

use stdClass;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class RetrieveAndCheckVerificationControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        exec('bin/console doctrine:migrations:migrate -n --env=test');
        parent::setUp();
    }

    /**
     * @test
     */
    public function itShouldReturnAndCheckTheVerificationInfo()
    {
        $content = $this->itShouldReturnTheVerificationInfo();

        $this->itShouldCheckTheVerificationInfo($content->verificationId, $content->code);
    }

    public function itShouldReturnTheVerificationInfo(): stdClass
    {
        $response = $this->getResponseFromRequest('verifications', '{"phoneNumber":"611 11 11 11"}');
        $this->assertEquals(200, $response->getStatusCode());

        $content = json_decode($response->getContent());

        return $content;
    }

    public function itShouldCheckTheVerificationInfo(string $verificationId, string $code): void
    {
        $response = $this->getResponseFromRequest('verifications/'.$verificationId, '{"code":"'.$code.'"}');

        $this->assertEquals(200, $response->getStatusCode());

        $content = json_decode($response->getContent());

        $this->assertTrue($content);
    }



    private function getResponseFromRequest(string $endpoint, string $data): JsonResponse
    {
        $this->client->request(
            'POST',
            '/'.$endpoint,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            $data
        );

        return $this->client->getResponse();
    }

    protected function tearDown(): void
    {
        exec('bin/console doctrine:database:drop --force --env=test');
        parent::tearDown();
    }
}
