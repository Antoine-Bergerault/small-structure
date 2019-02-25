<?php

class router{

    static function call(){

        $url = $GLOBALS['URL'];
        $params = [];

        $method = $_SERVER['REQUEST_METHOD'];
        $method = strtolower($method);

        if($method == 'get'){
            $parts = parse_url((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
            parse_str($parts['query'] ?? '', $query);
            $params = $query;
        }else if($method == 'post'){
            $params = $_POST;
        }

        return self::view($url, $method, $params);

    }

    static function view($url, $method, $params){

        if(file_exists(VIEWS . "/$method/" . $url . '.php')){

            $title = str_replace('/', ' - ', $url);
            include(VIEWS . "/$method/" . $url. '.php');
        
        }else if( file_exists(VIEWS . "/get-post/" . $url . '.php')){
        
            $title = str_replace('/', ' - ', $url);
            include(VIEWS . "/get-post/" . $url . '.php');
        
        }else{
        
            return '<h1>404 ERROR</h1>';
        
        }

    }

}