<?php

class Route {

    private $routes = array();
    private $postData;

    public function __construct($response = '') {
        if(file_get_contents('php://input') != NULL) {
            $this->postData = file_get_contents('php://input');
        }
    }

    public function getRoutes() {
        return $this->routes;
    }

    public function get($url, $callback) {
        $rota = array (
            "url" => $url,
            "callback" => $callback,
            "method" => 'GET'
        );
        array_push($this->routes, $rota);
    }

    public function post($url, $callback) {
        $rota = array (
            "url" => $url,
            "callback" => $callback,
            "method" => 'POST',
            "data" => $this->postData
        );
        array_push($this->routes, $rota);
    }

    public function put($url, $callback) {
        $rota = array (
            "url" => $url,
            "callback" => $callback,
            "method" => 'PUT',
            "data" => $this->postData
        );
        array_push($this->routes, $rota);
    }

    public function delete($url, $callback) {
        $rota = array (
            "url" => $url,
            "callback" => $callback,
            "method" => 'DELETE',
            "data" => $this->postData
        );
        array_push($this->routes, $rota);
    }
}