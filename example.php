<?php

use src\Clients\GuzzleAdapter;
use src\Decorator\MiddleDecorator;

require_once './vendor/autoload.php';

// $imagesApi = new \src\APIs\ImagesApi(new GuzzleAdapter);

// print_r($imagesApi->search(10, 0));

// $facade = new \src\ApiFacade(new GuzzleAdapter());

$facade = new \src\ApiFacade(new MiddleDecorator(new GuzzleAdapter()));

print_r(($facade->images())->search(5, 0));
echo '<br/><br/>';
print_r(($facade->categories())->search(5, 0));
echo '<br/><br/>';
print_r(($facade->favourites())->search(3, 0));
