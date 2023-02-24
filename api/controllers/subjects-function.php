<?php
require_once("../config.php");

function viewSubjects($connection) {
    $sql = "SELECT * FROM subjects";
    
    $row = SelectExecuteStatement($connection, $sql, []);
    $count = 0;

    while($row) {
        $categories[$count] = array (
            "description" => $row["subjdesc"],
            "year" => $row["year"],
        );

        $count++;
    }

    return $categories;
}