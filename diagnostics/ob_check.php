<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';

echo 'initial:' . ob_get_level() . PHP_EOL;

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

echo 'after handle:' . ob_get_level() . PHP_EOL;

$kernel->terminate($request, $response);

echo 'after terminate:' . ob_get_level() . PHP_EOL;

// print response status for sanity
echo 'status:' . $response->getStatusCode() . PHP_EOL;
