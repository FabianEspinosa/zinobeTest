<?php
declare (strict_types = 1);

namespace App\Kernel;

class Router
{

    protected static $getRoutes;
    protected static $postRoutes;

    public static function get(string $url, array $callback)
    {
        self::$getRoutes[$url] = $callback;
    }

    public static function post(string $url, array $callback)
    {
        self::$postRoutes[$url] = $callback;
    }

    public function register (string $filename) {
        include_once(__DIR__.'/../Http/'.$filename);
    }

    public function resolve (Request $request) {
        $callback = null;
        switch($request->getMethod()){
            case 'GET':
                $callback = self::$getRoutes[$request->getUrl()];
                break;
            case 'POST':
                $callback = self::$postRoutes[$request->getUrl()];               
                break;
        }

        if ($callback != null) {
            call_user_func($callback, $request);
        } else {
            echo 'Page not found';
        }
    }


}
