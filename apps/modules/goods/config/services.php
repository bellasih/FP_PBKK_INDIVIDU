<?php

use Phalcon\Mvc\View;

$di['view'] = function () {
    $view = new View();
    $view->setViewsDir(__DIR__ . '/modules/goods/views');

    $view->registerEngines(
        [
            ".volt" => "voltService",
        ]
        );

    return $view;
};
