<?php
require_once("../config.php");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if(strtoupper($requestMethod) == get) {
    $data = $_GET["type"];

    //GET SUBJECTS
    if($data == "getTeachers") {
        $sql = "SELECT username, first, middle, last FROM accounts WHERE accountType = ?";
        $params = ["i", 1];
        
        $result = SelectExecuteStatement($con, $sql, $params);
        $teachers = array();
    
        $count = 0;
        $flag = false;
    
        while($row = $result -> fetch_assoc()) {
            $flag = true;
    
            $teachers[$count] = array (
                "username" => $row["username"],
                "first_name" => $row["first"],
                "middle_name" => $row["middle"],
                "last_name" => $row["last"],
            );
    
            $count++;
        }
    
        if($flag) {
            $result = array(
                "type" => "success",
                "content" => $teachers
            );
        }
        else {
            $result = array(
                "type" => "error",
                "message" => "No teacher available!"
            );
        }

        output(json_encode($result), "HTTP/1.1 200 OK");
    }

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