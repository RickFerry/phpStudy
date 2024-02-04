<?php

require_once 'vendor/autoload.php';

use Ferry\CourseSearchEngine\Search;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client(['base_uri' => 'https://www.alura.com.br/cursos-online-programacao/php', 'verify' => false]);
try {
    $search = new Search($client, new Crawler());
    $courses = $search->search('/cursos-online-programacao/php');
    foreach ($courses as $course) {
        echo $course;
    }
} catch (GuzzleException $e) {
    echo $e->getMessage();
}
