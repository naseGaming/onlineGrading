<?php
require_once("../config.php");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if(strtoupper($requestMethod) == get) {
    $key = array_keys($_GET);

    //GET METHOD FOR GETTING THE MOST RECENT GRADES
    if(count($key) == 0 ) {
        $student_number = $_SESSION["userName"];
        $date = date("Y");

        $sql = "SELECT s.subjdesc, g.first_grading, g.second_grading, g.third_grading, g.fourth_grading, g.final_grade FROM grades g LEFT JOIN subjects s ON g.subjCode = s.subjcode WHERE g.studentNumber = ? AND g.schoolYear = ?";
        $params = ["ss", $student_number, $date];
        
        $result = SelectExecuteStatement($con, $sql, $params);
        $grades = array();
    
        $count = 0;
        $flag = false;
    
        while($row = $result -> fetch_assoc()) {
            $flag = true;
    
            $grades[$count] = array (
                "description" => $row["subjdesc"],
                "first_grading" => $row["first_grading"] != null ?: "N/A",
                "second_grading" => $row["second_grading"] != null ?: "N/A",
                "third_grading" => $row["third_grading"] != null ?: "N/A",
                "fourth_grading" => $row["fourth_grading"] != null ?: "N/A",
                "final_grade" => $row["final_grade"] != null ?: "N/A",
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
                "type" => "empty",
                "message" => "No records available for this school year!"
            );
        }

        output(json_encode($result), array('Content-Type: application/json', "HTTP/1.1 200 OK"));
    }
    if(isset($_GET["year"])) {
        $student_number = $_SESSION["userName"];
        $date = $_GET["year"];

        $sql = "SELECT s.subjdesc, g.first_grading, g.second_grading, g.third_grading, g.fourth_grading, g.final_grade FROM grades g LEFT JOIN subjects s ON g.subjCode = s.subjcode WHERE g.studentNumber = ? AND g.schoolYear = ? ORDER BY s.subjdesc";
        $params = ["ss", $student_number, $date];
        
        $result = SelectExecuteStatement($con, $sql, $params);
        $grades = array();
    
        $count = 0;
        $flag = false;
    
        while($row = $result -> fetch_assoc()) {
            $flag = true;
    
            $grades[$count] = array (
                "description" => $row["subjdesc"],
                "first_grading" => $row["first_grading"] != null ? $row["first_grading"] : "N/A",
                "second_grading" => $row["second_grading"] != null ? $row["second_grading"] : "N/A",
                "third_grading" => $row["third_grading"] != null ? $row["third_grading"] : "N/A",
                "fourth_grading" => $row["fourth_grading"] != null ? $row["fourth_grading"] : "N/A",
                "final_grade" => $row["final_grade"] != null ? $row["final_grade"] : "N/A",
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
                "type" => "empty",
                "message" => "No records available for this school year!"
            );
        }

        output(json_encode($result), array('Content-Type: application/json', "HTTP/1.1 200 OK"));
    }
    //SERVER SIDE GET METHOD FOR TEACHERS TO BE DISPLAYED IN A TABLE
    if(isset($_GET["page"]) && isset($_GET["subject"]) && isset($_GET["section"])) {
        $page = $_GET["page"];

        $page--;
        $page *= max_page_count;

        $sql = "SELECT g.id, g.studentNumber, s.subjdesc, g.first_grading, g.second_grading, g.third_grading, g.fourth_grading, g.final_grade FROM grades g LEFT JOIN subjects s ON g.subjCode = s.subjcode WHERE g.section = ? and s.subjID = ? ORDER BY s.subjdesc Limit $page, ".max_page_count;
        $params = ["ss", $_GET["section"], $_GET["subject"]];
        
        $result = SelectExecuteStatement($con, $sql, $params);
        $teacher = array();
    
        $count = 0;
        $flag = false;
    
        while($row = $result -> fetch_assoc()) {
            $flag = true;
    
            $teacher[$count] = array (
                "id" => $row["id"],
                "student_number" => $row["studentNumber"],
                "subjdesc" => $row["subjdesc"],
                "first_grading" => $row["first_grading"],
                "second_grading" => $row["second_grading"],
                "third_grading" => $row["third_grading"],
                "fourth_grading" => $row["fourth_grading"],
                "final_grade" => $row["final_grade"],
            );
    
            $count++;
        }
        
        $sql = "SELECT COUNT(g.id) as max_count FROM grades g LEFT JOIN subjects s ON g.subjCode = s.subjcode WHERE g.section = ? and s.subjID = ?";
        $params = ["ss", $_GET["section"], $_GET["subject"]];

        $result = SelectExecuteStatement($con, $sql, $params);
        $length = 0;

        while($row = $result -> fetch_assoc()) {
            $length = $row["max_count"];
        }
    
        if($flag) {
            $result = array(
                "type" => "success",
                "length" => $length,
                "content" => $teacher
            );
        }
        else {
            $result = array(
                "type" => "empty",
                "length" => 7,
                "message" => "No grades to display!"
            );
        }

        output(json_encode($result), array('Content-Type: application/json', "HTTP/1.1 200 OK"));
    }
    //SERVER SIDE GET METHOD FOR TEACHERS TO BE DISPLAYED IN A TABLE
    if(isset($_GET["page"])) {
        $page = $_GET["page"];

        $page--;
        $page *= max_page_count;

        $sql = "SELECT g.id, g.studentNumber, s.subjdesc, g.first_grading, g.second_grading, g.third_grading, g.fourth_grading, g.final_grade FROM grades g LEFT JOIN subjects s ON g.subjCode = s.subjcode WHERE g.section = ?  ORDER BY s.subjdesc Limit $page, ".max_page_count;
        $params = ["s", $_GET["section"]];
        
        $result = SelectExecuteStatement($con, $sql, $params);
        $teacher = array();
    
        $count = 0;
        $flag = false;
    
        while($row = $result -> fetch_assoc()) {
            $flag = true;
    
            $teacher[$count] = array (
                "id" => $row["id"],
                "student_number" => $row["studentNumber"],
                "subjdesc" => $row["subjdesc"],
                "first_grading" => $row["first_grading"],
                "second_grading" => $row["second_grading"],
                "third_grading" => $row["third_grading"],
                "fourth_grading" => $row["fourth_grading"],
                "final_grade" => $row["final_grade"],
            );
    
            $count++;
        }
        
        $sql = "SELECT COUNT(g.id) as max_count FROM grades g LEFT JOIN subjects s ON g.subjCode = s.subjcode WHERE g.section = ?";
        $params = ["s", $_GET["section"]];

        $result = SelectExecuteStatement($con, $sql, $params);
        $length = 0;

        while($row = $result -> fetch_assoc()) {
            $length = $row["max_count"];
        }
    
        if($flag) {
            $result = array(
                "type" => "success",
                "length" => $length,
                "content" => $teacher
            );
        }
        else {
            $result = array(
                "type" => "empty",
                "length" => 7,
                "message" => "No grades to display!"
            );
        }

        output(json_encode($result), array('Content-Type: application/json', "HTTP/1.1 200 OK"));
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