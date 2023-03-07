<?php
require_once("../config.php");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if(strtoupper($requestMethod) == get) {
    $key = array_keys($_GET);

    if(isset($_GET["page"])) {
        $page = $_GET["page"];

        $page--;
        $page *= 5;

        $sql = "SELECT studentNumber, first, middle, last, year, section, schoolYear FROM studentlist WHERE is_deleted = ? Limit $page, 5";
        $params = ["i", 0];
        
        $result = SelectExecuteStatement($con, $sql, $params);
        $subject = array();
    
        $count = 0;
        $flag = false;
    
        while($row = $result -> fetch_assoc()) {
            $flag = true;
    
            $subject[$count] = array (
                "student_number" => $row["studentNumber"],
                "full_name" => $row["first"] . " " . $row["middle"] . " " . $row["last"],
                "year" => $row["year"],
                "section" => $row["section"],
                "school_year" => $row["schoolYear"]
            );
    
            $count++;
        }
        
        $sql = "SELECT COUNT(studentNumber) AS max_count FROM studentlist WHERE is_deleted = ?";
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