<?php

namespace Ferry\CourseSearchEngine;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\DomCrawler\Crawler;

class Search
{
    private ClientInterface $client;
    private Crawler $crawler;

    public function __construct(ClientInterface $client, Crawler $crawler)
    {
        $this->client = $client;
        $this->crawler = $crawler;
    }

    /**
     * @throws GuzzleException
     */
    public function search(string $url): array
    {
        $response = $this->client->request('GET', $url);
        $html = $response->getBody();
        $this->crawler = new Crawler($html);
        return $this->crawler->filter('span.card-curso__nome')->each(function (Crawler $node) {
            return $node->text() . PHP_EOL;
        });
    }
}
