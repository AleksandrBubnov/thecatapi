<?php

use GuzzleHttp\Client;
use src\Clients\GuzzleAdapter;
use src\ApiFacade;
use src\Decorator\MiddleDecorator;

require_once './vendor/autoload.php';

// $imagesApi = new \src\APIs\ImagesApi(new GuzzleAdapter);

// print_r($imagesApi->search(10, 0));

// $facade = new \src\ApiFacade(new GuzzleAdapter());

$facade = new \src\ApiFacade(new MiddleDecorator(new GuzzleAdapter));

print_r($facade->images()->search(10, 0));
echo '<br/><br/>';
print_r($facade->categories()->search(10, 0));
