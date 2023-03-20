<?php
require_once("../config.php");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if(strtoupper($requestMethod) == get) {
    $key = array_keys($_GET);

    //GET METHOD FOR GETTING ALL TEACHERS
    if(count($key) == 0 ) {
        $student_number = $_SESSION["userName"];
        $date = date("Y");

        $sql = "SELECT s.subjdesc, g.grade, g.period FROM grades g LEFT JOIN subjects s ON g.subjCode = s.subjcode WHERE g.studentNumber = ? AND g.schoolYear = ? ORDER BY g.period asc";
        $params = ["ss", $student_number, $date];
        
        $result = SelectExecuteStatement($con, $sql, $params);
        $grades = array();
    
        $count = 0;
        $flag = false;
    
        while($row = $result -> fetch_assoc()) {
            $flag = true;
    
            $grades[$count] = array (
                "description" => $row["subjdesc"],
                "grade" => $row["grade"],
                "period" => $row["period"],
            );
    
            $count++;
        }
    
        if($flag) {
            $result = array(
                "type" => "success",
                "content" => $grades
            );
        }
        else {
            $result = array(
                "type" => "error",
                "message" => "No records available for this school year!"
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