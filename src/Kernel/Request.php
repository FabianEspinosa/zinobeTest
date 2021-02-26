<?php

namespace App\Kernel;

class Request
{
    protected $contentType;
    protected $method;
    protected $url;
    protected $ip;
    protected $parameters;

    public function __construct()
    {
        $this->contentType = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : 'APPLICATION/JSON';
        $this->method      = strtoupper($_SERVER['REQUEST_METHOD']);
        $this->url         = $_SERVER['PATH_INFO'] ?? '/';
        $this->ip          = $_SERVER['REMOTE_ADDR'];
        $this->prepareParams();
    }

    public function getContentType()
    {
        return $this->contentType;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    protected function prepareParams()
    {
        
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET') {
            $params = $_REQUEST;
        } else {
            if (strtoupper($_SERVER['CONTENT_TYPE']) == 'APPLICATION/JSON') {
                $params = json_decode(file_get_contents('php://input'), true);
            } else {
                $params = isset($_POST) ? $_POST : [];
            }
        }
        if (isset($params)) {
            $this->parameters = filter_var_array($params, FILTER_SANITIZE_SPECIAL_CHARS);
        }
    }

    public function input($fieldName)
    {

        if (isset($this->parameters)) {
            if (!array_key_exists($fieldName, $this->parameters)) {
                header("Content-type: " . $this->contentType, true, 422);
                return ['errors' => "$fieldName no existe"];
            }
            return $this->parameters[$fieldName];
        } 
        return false;
    }

}
