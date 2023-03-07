<?php
require_once("../config.php");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if(strtoupper($requestMethod) == get) {
    
    error("Page not found", "HTTP/1.1 404 Not Found");
}

else if(strtoupper($requestMethod) == post) {

    error("Page not found", "HTTP/1.1 404 Not Found");
}

else if(strtoupper($requestMethod) == put) {
    
    error("Page not found", "HTTP/1.1 404 Not Found");
}

else if(strtoupper($requestMethod) == delete) {
    
    error("Page not found", "HTTP/1.1 404 Not Found");
}

else {
    error("Method not supported", "HTTP/1.1 405 Method Not Allowed");
}