<?php
// api/index.php

// Define BASE_PATH caso ainda não esteja definido
define('BASE_PATH', dirname(__DIR__));

// Inclui o autoload
require BASE_PATH . '/src/autoload.php';

// Inclui as rotas da API
require BASE_PATH . '/src/routes/api.php';
