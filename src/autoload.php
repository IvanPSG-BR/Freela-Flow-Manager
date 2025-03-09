<?php
spl_autoload_register(function ($class) {
    // Converte os namespaces em caminhos (assumindo que suas classes estão dentro de src/)
    $file = BASE_PATH . '/src/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});
