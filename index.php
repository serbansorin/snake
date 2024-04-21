<?php
error_reporting(E_ERROR);

require 'vendor/autoload.php';

use Game\App;

$defaultBoard =
    [
        'width' => 20,
        'height' => 20
    ];

$app = new App($defaultBoard['width'], $defaultBoard['height']);

$app->playGame();