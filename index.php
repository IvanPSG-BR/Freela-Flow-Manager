<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

// Inclui o arquivo de configurações
require __DIR__ . '/config/config.php';

// Inclui o autoload para carregar classes automaticamente
require __DIR__ . '/src/autoload.php';

// Se a URL contiver o parâmetro 'api', redireciona para o sistema de API
if (isset($_GET['api'])) {
    require __DIR__ . '/service/index.php';
    exit;
}

// Roteamento para páginas web
// Usa ?page=nome para definir qual view carregar (padrão: home)
$page = $_GET['page'] ?? 'home';
$viewPath = __DIR__ . "/src/views/$page/{$page}.php";

if (file_exists($viewPath)) {
    require $viewPath;
} else {
    http_response_code(404);
    echo "Página não encontrada!";
}
