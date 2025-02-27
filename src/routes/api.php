<?php
// src/routes/api.php

require BASE_PATH . '/src/controllers/api_controller.php';

// Obtém a rota (endpoint) da API via parâmetro 'route'
$route = $_GET['route'] ?? 'default';

// Configura o header para retornar JSON
header('Content-Type: application/json');

// Validação do método HTTP
$method = $_SERVER['REQUEST_METHOD'];

try {
    // Roteamento simples para a API
    switch ($route) {
        case 'users':
            if ($method !== 'GET') {
                throw new Exception('Método não permitido');
            }
            echo json_encode(\controllers\ApiController::getUsers());
            break;
        case 'projects':
            if ($method !== 'GET') {
                throw new Exception('Método não permitido');
            }
            echo json_encode(\controllers\ApiController::getProjects());
            break;
        default:
            echo json_encode(['message' => 'Rota não encontrada', 'route' => $route]);
            http_response_code(404);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
