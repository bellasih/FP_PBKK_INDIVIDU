<?php

use Phalcon\Mvc\View;

$di['view'] = function () {
    $view = new View();
    $view->setViewsDir(__DIR__ . '/modules/order/views');

    $view->registerEngines(
        [
            ".volt" => "voltService",
        ]
        );

    return $view;
};
