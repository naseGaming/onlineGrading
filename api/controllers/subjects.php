<?php
require_once("../config.php");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if(strtoupper($requestMethod) == get) {
    $key = array_keys($_GET);

    //GET SUBJECTS
    if(isset($_GET["page"])) {
        $page = $_GET["page"];

        $page--;
        $page *= 5;

        $sql = "SELECT s.subjID, s.subjcode, s.subjdesc, s.year, s.teacher, a.username, a.first, a.last FROM subjects s LEFT JOIN accounts a on s.teacher = a.username ORDER BY s.subjID Limit $page, 5";
        
        $result = SelectExecuteStatement($con, $sql, []);
        $subject = array();
    
        $count = 0;
        $flag = false;
    
        while($row = $result -> fetch_assoc()) {
            $flag = true;
    
            $subject[$count] = array (
                "id" => $row["subjID"],
                "code" => $row["subjcode"],
                "description" => $row["subjdesc"],
                "year" => $row["year"],
                "teacher" => $row["first"] . " " . $row["last"],
            );
    
            $count++;
        }
        
        $sql = "SELECT COUNT(subjID) AS max_count FROM subjects";
        $result = SelectExecuteStatement($con, $sql, []);
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
                "message" => "No subject to display!"
            );
        }

        output(json_encode($result), "HTTP/1.1 200 OK");
    }
    if(isset($_GET["id"])) {
        $id = $_GET["id"];

        $sql = "SELECT subjcode, subjdesc, year, teacher FROM subjects WHERE subjID = ?";
        $params = ["i", $id];
        $subject = array();
        
        $result = SelectExecuteStatement($con, $sql, $params);
        $flag = false;

        while($row = $result -> fetch_assoc()) {
            $flag = true;

            $subject = array(
                "code" => $row["subjcode"],
                "description" => $row["subjdesc"],
                "year" => $row["year"],
                "teacher" => $row["teacher"]
            );
        }

        if($flag) {
            $result = array(
                "type" => "success",
                "content" => $subject
            );
        }
        else {
            error("Bad Request", "HTTP/1.1 403 Bad Request");
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