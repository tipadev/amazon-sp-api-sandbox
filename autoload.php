<?php

spl_autoload_register(function ($class) {
    $filePath = __DIR__ . '/src/' . str_replace('\\', '/', $class) . '.php';
    require_once($filePath);
});