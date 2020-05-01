<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use PHPUnit\Framework\TestCase;

class DomainsTest extends TestCase
{
    // protected function setUp(): void
    // {
    //     parent::setUp();
    //     $path = 'tests/fixtures/testSite.html';
    //     $body = file_get_contents($path);
    //     $mock = new MockHandler([
    //         new Response(200, ['Content-Length' => 11], $body)
    //     ]);
    //     $handler = HandlerStack::create($mock);
    //     $this->app->bind('GuzzleClient', function ($app) use ($handler) {
    //         return new Client(['handler' => $handler]);
    //     });
    // }

}
