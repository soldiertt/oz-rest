<?php
// Routes

use Oz\model\Person;
use Oz\model\Holiday;

/* PERSON */
$app->get('/person', function ($request, $response, $args) {
    //$category = $request->getQueryParam("category");
    $this->logger->info("Slim-Skeleton '/person");
    $persons = Person::findAll();

    return $response->withStatus(200)
    ->withHeader('Content-Type', 'application/json')
    ->write(json_encode($persons));
});

$app->get('/person/{id}', function ($request, $response, $args) {
    $id = $request->getAttribute('id');
    $this->logger->info("Slim-Skeleton '/person/".$id);
    $person = Person::find($id);
    if ($person === false) {
        return notFound($response, "Could not find person with id ".$id);
    } else {
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($person));
    }
});

$app->post('/person', function ($request, $response, $args) {
    $this->logger->info("Slim-Skeleton POST '/person");
    $parsedPerson = $request->getParsedBody();
    $personId = Person::create($parsedPerson);

    return $response->withStatus(200)
    ->withHeader('Content-Type', 'application/json')
    ->write(json_encode($personId));
});

/* HOLIDAYS */
$app->get('/holiday', function ($request, $response, $args) {
    $this->logger->info("Slim-Skeleton '/holiday");
    $holidays = Holiday::findAll();

    return $response->withStatus(200)
    ->withHeader('Content-Type', 'application/json')
    ->write(json_encode($holidays));
});
