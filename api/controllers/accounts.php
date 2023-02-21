<?php
require_once("../config.php");
require_once("accounts-functions.php");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if(strtoupper($requestMethod) == get) {
    
    error("Page not found", "HTTP/1.1 404 Not Found");
}

else if(strtoupper($requestMethod) == post) {
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);

    if($data->type == "login") {
        $content = $data->content;

        $result = json_encode(login($content->username, $content->password, $con));

        output($result, "HTTP/1.1 200 OK");
    }

    error("Page not found", "HTTP/1.1 404 Not Found");
}

else if(strtoupper($requestMethod) == put) {
    
    error("Page not found", "HTTP/1.1 404 Not Found");
}

else if(strtoupper($requestMethod) == delete) {
    
    error("Page not found", "HTTP/1.1 404 Not Found");
}

else {
    error("Method not supported", "HTTP/1.1 422 Unprocessable Entity");
}