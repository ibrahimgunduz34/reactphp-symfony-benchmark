<?php

use App\Kernel;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\HttpServer;
use React\Socket\SocketServer;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    $kernel = new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);

    $httpFoundationFactory = new HttpFoundationFactory();
    $psr7Factory = new PsrHttpFactory();

    $callback = function (ServerRequestInterface $request) use ($kernel, $httpFoundationFactory, $psr7Factory)  {
        try {
            $sfRequest = $httpFoundationFactory->createRequest($request);
            $sfResponse = $kernel->handle($sfRequest);
            $kernel->terminate($sfRequest, $sfResponse);

//            echo "{$sfRequest->getMethod()} /{$sfRequest->getPathInfo()} Response status: {$sfResponse->getStatusCode()}" . PHP_EOL;

            return $psr7Factory->createResponse($sfResponse);
        } catch (Throwable $exception) {
            $response = \React\Http\Message\Response::plaintext($exception->getMessage());
            $response->withStatus(\React\Http\Message\Response::STATUS_INTERNAL_SERVER_ERROR);
            return $response;
        }
    };

    $httpServer = new HttpServer($callback);

    $httpServer->on('error', function(\Exception $exception) {
        echo $exception->getMessage() . PHP_EOL;
        echo $exception->getFile() . ':' . $exception->getLine() . PHP_EOL;
        echo $exception->getTraceAsString() . PHP_EOL;
    });

    $socket = new SocketServer("0.0.0.0:8080");
    $httpServer->listen($socket);

    echo "Server running at http://127.0.0.1:8080" . PHP_EOL;
};

