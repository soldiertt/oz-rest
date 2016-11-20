<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
$corsOptions = array(
    "origin" => array("http://localhost:3000", "http://www.local.dev:3000", "http://www.local.dev:8080"),
    "allowMethods" => array("GET, HEAD, PUT, OPTIONS, POST, DELETE")
);
$cors = new \CorsSlim\CorsSlim($corsOptions);
$app->add($cors);