<?php
// src/routes/api.php

require BASE_PATH . '/src/controllers/api_controller.php';

// Obtém a rota (endpoint) da API via parâmetro 'route'
$route = $_GET['route'] ?? 'default';

// Validação do método HTTP
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

try {
    // Configura o header para retornar JSON antes de qualquer saída
    header('Content-Type: application/json');
    
    // Roteamento simples para a API
    switch ($route) {
        case 'users':
            if ($method !== 'GET') {
                http_response_code(405);
                throw new Exception('Método não permitido');
            }
            echo json_encode(\controllers\ApiController::getUsers());
            break;
        case 'projects':
            if ($method !== 'GET') {
                http_response_code(405);
                throw new Exception('Método não permitido');
            }
            echo json_encode(\controllers\ApiController::getProjects());
            break;
        default:
            http_response_code(404);
            echo json_encode(['message' => 'Rota não encontrada', 'route' => $route]);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
