<?php
require __DIR__ . '/../vendor/autoload.php';
// Render the Blade view `app` with a fake user prop so we can inspect HTML
$props = ['user' => ['name' => 'Local Test User']];
$view = view('app', ['props' => $props])->render();
echo $view;
