<?php
// Definição do caminho base
define('BASE_PATH', dirname(__DIR__));

// Autoload das classes do MVC
require BASE_PATH . '/src/autoload.php';

// Obtém a rota da URL
$uri = $_SERVER['REQUEST_URI'];

// Define a página padrão (home)
if ($uri === '/' || $uri === '/index.php') {
    require BASE_PATH . '/src/views/home/home.php';
} /*elseif ($uri === '/outra_pagina') {
    require BASE_PATH . '/src/Views/outra_pagina/outra_pagina.php';
}*/ else {
    http_response_code(404);
    echo "Página não encontrada!";
}
