<?php

//Create Database Conection-------------------
function dbConn() {
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "saloon";

    $conn = new mysqli($server, $username, $password, $db);

    if ($conn->connect_error) {
        die("Database Error : " . $conn->connect_error);
    } else {
        return $conn;
    }
}

//End Database Conection-----------------------
//Data Clean------------------------------------------
function dataClean($data = null) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

//End Data Clean

function checkPermission($current_url = null, $userid = null) {
    $parsed_url = parse_url($current_url);
    $path = $parsed_url['path'];
    $file_name = basename($path, '.php');
    $folder_name = basename(dirname($path));

    $db = dbConn();
    $sql = "SELECT * FROM `user_modules`  um "
    . "INNER JOIN modules  m ON m.Id=um.ModuleId "
    . "WHERE um.UserId='$userid' AND m.Path='$folder_name' AND m.File='$file_name';";

    $result = $db->query($sql);

    if ($result->num_rows <= 0) {
        return false;
    }else{
        return true;
    }
}
