<?php

namespace Ferry\CourseSearchEngine;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\DomCrawler\Crawler;

class SearchTest extends TestCase
{
    private ClientInterface&MockObject $httpClientMock;
    private string $url = 'url-teste';

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $html = <<<FIM
        <html lang="">
            <body>
                <span class="card-curso__nome">Curso Teste 1</span>
                <span class="card-curso__nome">Curso Teste 2</span>
                <span class="card-curso__nome">Curso Teste 3</span>
            </body>
        </html>
        FIM;


        $stream = $this->createMock(StreamInterface::class);
        $stream
            ->expects($this->once())
            ->method('__toString')
            ->willReturn($html);

        $response = $this->createMock(ResponseInterface::class);
        $response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($stream);

        $httpClient = $this
            ->createMock(ClientInterface::class);
        $httpClient
            ->expects($this->once())
            ->method('request')
            ->with('GET', $this->url)
            ->willReturn($response);

        $this->httpClientMock = $httpClient;
    }

    /**
     * @throws GuzzleException
     */
    public function testSearcherMustReturnCourses()
    {
        $crawler = new Crawler();
        $search = new Search($this->httpClientMock, $crawler);
        $courses = $search->search($this->url);

        $this->assertCount(3, $courses);
        $this->assertEquals('Curso Teste 1', trim($courses[0]));
        $this->assertEquals('Curso Teste 2', trim($courses[1]));
        $this->assertEquals('Curso Teste 3', trim($courses[2]));
    }
}
