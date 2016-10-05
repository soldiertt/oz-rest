<?php
// Routes

use Arthurius\model\Product;

$app->get('/product', function ($request, $response, $args) {
    $category = $request->getQueryParam("category");
    $this->logger->info("Slim-Skeleton '/product/".$category."' route");
    $products = Product::findByCategory($category);

    return $response->withStatus(200)
    ->withHeader('Content-Type', 'application/json')
    ->write(json_encode($products));
});

$app->get('/product/{id}', function ($request, $response, $args) {
    $id = $request->getAttribute('id');
    $this->logger->info("Slim-Skeleton '/product/".$id."' route");
    $product = Product::find($id);
    if ($product === false) {
        return notFound($response, "Could not find product with id ".$id);
    } else {
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($product));
    }
});

function notFound($response, $message) {
    $jsonResp = new \Arthurius\JsonResponse(true, $message);
    return $response->withStatus(404)
    ->withHeader('Content-Type',  'application/json')
    ->write(json_encode($jsonResp));
}

