<?php
declare (strict_types = 1);
namespace App\Kernel;

class Response
{
    public static function json(array $data)
    {
        header("Content-Type: application/json");
        echo json_encode($data);
    }

    public static function view(string $viewName, array $data = [])
    {
        $viewFile = str_replace('.','/',$viewName);        
        $viewPath = __DIR__."/../Http/Views/$viewFile.php";
        $layoutPath = __DIR__ . "/../Http/Views/layout.php";

        if (!file_exists($viewPath)) {
            echo "La vista $viewName no existe";
            return false;
        }

        ob_start();
        extract($data);
        include_once $viewPath;
        $content = ob_get_clean();
        include_once $layoutPath;
        $viewRender = ob_get_clean();       
        echo $viewRender;
    }

    public static function error(int $code){

        http_response_code($code);

        $viewPath = __DIR__ . "/../Http/Views/Errors/$code.php";
        $layoutPath = __DIR__ . "/../Http/Views/layout.php";

        if (!file_exists($viewPath)) {
            echo "View $code does not exists!";
            return false;
        }

        ob_start();
        include_once $viewPath;
        $content = ob_get_clean();
        include_once $layoutPath;
        $viewRender = ob_get_clean();       
        echo $viewRender;

    }

    public static function redirect(string $path){
        header("Location: $path");       
    }

}
