<?php

namespace controllers;

// use models\user;
// use models\projects;

class ApiController {
    // Retorna uma lista de usuários (placeholder)
    public static function getUsers() {
        // Em um caso real, você buscaria no banco de dados
        return [
            ['id' => 1, 'name' => 'Alice'],
            ['id' => 2, 'name' => 'Bob']
        ];
    }

    // Retorna uma lista de projetos (placeholder)
    public static function getProjects() {
        return [
            ['id' => 101, 'title' => 'Site institucional'],
            ['id' => 102, 'title' => 'Aplicativo Mobile']
        ];
    }
}
