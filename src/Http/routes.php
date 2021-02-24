<?php

use App\Kernel\Router;

Router::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Router::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Router::post('/create/user', [App\Http\Controllers\CustomerDataController::class, 'createUser']);