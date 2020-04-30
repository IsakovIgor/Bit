<?php

use App\Controller\Factory\AuthControllerFactory;
use App\Controller\Factory\TransactionControllerFactory;
use App\Middleware\AuthMiddleware;
use App\Router\Router;

Router::get('/auth', AuthControllerFactory::class, 'index');
Router::post('/auth', AuthControllerFactory::class, 'auth');
Router::get('/', TransactionControllerFactory::class, 'index', [AuthMiddleware::class]);
Router::post('/', TransactionControllerFactory::class, 'withdrawal', [AuthMiddleware::class]);
