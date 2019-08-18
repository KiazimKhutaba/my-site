<?php

use Castels\Config;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

return
    [
        'twig' => function () {
            $loader = new FilesystemLoader(Config::AppViews);
            $twig = new Environment($loader,
                ['cache' => false]
                /*['cache' => __DIR__ . '/../cache']*/
            );
            return $twig;
        },

        'pdo' => function() {
            $instance = new PDO('mysql:host=localhost;dbname=castels_ru;charset=utf8', 'root', '');
            $instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
            $instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $instance;
        }
    ];