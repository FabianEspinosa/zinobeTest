<?php

use App\Kernel\Router;

#GET
Router::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Router::get('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
Router::get('/search', [App\Http\Controllers\CustomerDataController::class, 'welcome']);
Router::get('/register', [App\Http\Controllers\CustomerDataController::class, 'index']);
#POST
Router::post('/', [App\Http\Controllers\AuthController::class, 'login']);
Router::post('/register', [App\Http\Controllers\CustomerDataController::class, 'createUser']);
Router::post('/search', [App\Http\Controllers\CustomerDataController::class, 'searchUser']);
