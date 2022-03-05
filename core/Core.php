<?php

class Core {
    
    private $type;
    private $url;
    public $route;
    
    public function __construct() {
        $teste = $this->getCurrentRoute();
        $this->route = new Route();
    }

    private function getURL() {
        if(isset($_SERVER['REQUEST_URI'])) {

            $this->url = rtrim($_SERVER['REQUEST_URI'], '/');
            $this->url = filter_var($this->url, FILTER_SANITIZE_URL);
            $this->url = explode('/', $this->url);
            array_shift($this->url);

            return $this->url;
        }
    }

    private function getRequestType() {
        if(isset($_SERVER['REQUEST_METHOD'])) {
            $this->type = $_SERVER['REQUEST_METHOD'];

            return $this->type;
        }
    }

    private function getCurrentRoute($MODE = '') {
        $direcao = rtrim($_SERVER['REQUEST_URI'], '/');
        $direcao = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        $direcao = explode('/', $direcao);
        $novaDirecao = array();
        array_shift($direcao);
        array_shift($direcao);
        
        foreach ($direcao as $key => $value) {
            if(sizeof($direcao) < 2 && $value == "") {
                array_push($novaDirecao, "/");
                break;
            }
            
            array_push($novaDirecao, "/");
            array_push($novaDirecao, $value);
        }

        if($MODE == 'array') {
            return $novaDirecao;
        }

        return implode('', $novaDirecao);;
    }

    public function start() {

        $found = false;
        $usingRoute = array();
        foreach ($this->route->getRoutes() as $value) {
            if($value['url'] == $this->getCurrentRoute() && $value['method'] == $this->getRequestType()) {
                $found = true;
                $usingRoute = $value;
                break;
            }
        }

        if (!$found) {
            header("HTTP/1.1 404 Not Found");
            $response = array(
                "status" => 404,
                "data" => '404: Page not found!'
            );
        
            echo json_encode($response);
        } else {
            if($usingRoute['method'] == 'POST') {
                $usingRoute['callback']($usingRoute['data']);
            } else {
                $usingRoute['callback']();
            }
        }
    }

    public function showRoutes() {
        foreach ($this->route->getRoutes() as $value) {
            echo "Rota: " . $value['url'] . '<br>';
            echo "Method: " . $value['method'] . '<br>';
            echo '<br>';
        }
    }
}