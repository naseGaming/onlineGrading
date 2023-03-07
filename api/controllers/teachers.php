<?php
require_once("../config.php");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if(strtoupper($requestMethod) == get) {
    $key = array_keys($_GET);

    if(count($key) == 0 ) {
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
    if(isset($_GET["page"])) {
        $page = $_GET["page"];

        $page--;
        $page *= 5;

        $sql = "SELECT username, first, middle, last FROM accounts WHERE is_deleted = ? and accountType = ? Limit $page, 5";
        $params = ["ii", 0, 1];
        
        $result = SelectExecuteStatement($con, $sql, $params);
        $subject = array();
    
        $count = 0;
        $flag = false;
    
        while($row = $result -> fetch_assoc()) {
            $flag = true;
    
            $subject[$count] = array (
                "username" => $row["username"],
                "full_name" => $row["first"] . " " . $row["middle"] . " " . $row["last"],
            );
    
            $count++;
        }
        
        $sql = "SELECT COUNT(username) AS max_count FROM accounts WHERE is_deleted = ? and accountType = ?";
        $result = SelectExecuteStatement($con, $sql, $params);
        $length = 0;

        while($row = $result -> fetch_assoc()) {
            $length = $row["max_count"];
        }
    
        if($flag) {
            $result = array(
                "type" => "success",
                "length" => $length,
                "content" => $subject
            );
        }
        else {
            $result = array(
                "type" => "error",
                "message" => "No student to display!"
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