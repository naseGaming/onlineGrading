<?php
require_once("../config.php");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if(strtoupper($requestMethod) == get) {
    
}

else if(strtoupper($requestMethod) == post) {
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);

    if($data->type == "login") {
        $content = $data->content;

        echo json_encode(array(
            "username" => $content->username,
            "password" => $content->password
        ));
    }
}

else if(strtoupper($requestMethod) == put) {
    
}

else if(strtoupper($requestMethod) == delete) {
    
}

else {
    header("HTTP/1.1 404 Not Found");
}