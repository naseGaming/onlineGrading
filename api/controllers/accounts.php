<?php
require_once("../config.php");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if(strtoupper($requestMethod) == get) {
    
    error("Page not found", "HTTP/1.1 404 Not Found");
}

else if(strtoupper($requestMethod) == post) {
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);

    //POST LOGIN
    if($data->type == "login") {
        $content = $data->content;

        $sql = "SELECT * FROM accounts WHERE username = ? ";
        $params = ["s", $content->username];
        
        $result = SelectExecuteStatement($con, $sql, $params);
        $flag = false;
        
        while($row = $result -> fetch_assoc()) {
            $flag = true;
            if (password_verify($content->password, $row["password"])){
    
                $_SESSION["userID"] = $row["id"];
                $_SESSION["userName"] = $row["username"];
                $_SESSION["userRole"] = $row["accountType"];
    
                $result = array(
                    "type" => "success",
                    "role" => $row["accountType"]
                );
                break;
            }

            $result = array(
                "type" => "error",
                "message" => "Wrong password. Try again or click Forgot password to reset it."
            );
            break;
        }
        
        if(!$flag) {
            $result = array(
                "type" => "error",
                "message" => "Account does not exist. Try again or signup an account!"
            );
        }

        output(json_encode($result), "HTTP/1.1 200 OK");
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