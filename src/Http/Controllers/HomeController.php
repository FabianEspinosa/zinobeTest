<?php
declare (strict_types = 1);
namespace App\Http\Controllers;

use App\Kernel\Request;
use App\Kernel\Response;

class HomeController
{

    public function index(Request $request)
    {
        Response::view('login', $request->getParameters());      
    }
}
