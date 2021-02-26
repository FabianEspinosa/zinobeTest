<?php

use App\Kernel\Router;

Router::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Router::post('/', [App\Http\Controllers\AuthController::class, 'login']);
Router::get('/register', [App\Http\Controllers\CustomerDataController::class, 'index']);
Router::post('/register', [App\Http\Controllers\CustomerDataController::class, 'createUser']);
Router::get('/search', [App\Http\Controllers\CustomerDataController::class, 'search']);
