<?php
require_once("../config.php");

function viewSubjects($connection) {
    $sql = "SELECT * FROM subjects";
    
    $result = SelectExecuteStatement($connection, $sql, []);
    $subject = array();

    $count = 0;
    $flag = false;

    while($row = $result -> fetch_assoc()) {
        $flag = true;

        $subject[$count] = array (
            "description" => $row["subjdesc"],
            "year" => $row["year"],
        );

        $count++;
    }

    if($flag) {
        return array(
            "type" => "success",
            "content" => $subject
        );
    }

    return array(
        "type" => "error",
        "message" => "No subject to display!"
    );
}