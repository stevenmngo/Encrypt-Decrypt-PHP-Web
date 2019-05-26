<?php
//This file is for create database and tables if the database and tables are not exist

$conn = new mysqli($hn, $un, $pw);
if ($conn->connect_error) die ($conn->connect_error);

$result = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'Decryptoid' ");
$row = $result->fetch_assoc();

if (!empty($row)){
    createTables($conn );
}elseif (empty($row)){
    if (!$conn->query("CREATE DATABASE Decryptoid")) die ("Create Database Failed: " . $conn->error);
    createTables($conn );
}else {
     die ("Database access failed: " . $conn->error);
}
mysqli_free_result($result);

function createTables($conn ){
    $createFilesTable = "CREATE TABLE IF NOT EXISTS input (
                    username VARCHAR(80)  NOT NULL,
                    cipher CHAR(6) NOT NULL,
                    timeStamp  TIMESTAMP NOT NULL,
                    content TEXT  NOT NULL
                    )";
    $createUserTable = "CREATE TABLE IF NOT EXISTS users (
                    username VARCHAR(80)  NOT NULL,
                    email VARCHAR(80) NOT NULL,
                    password CHAR(40)   NOT NULL,
                    salt CHAR(4) NOT NULL,
                    PRIMARY KEY (username )
                    )";
    if (!$conn->query("use Decryptoid")) die (" Use Database Failed: " . $conn->error);
    if (!$conn->query($createFilesTable)) die ("Create Table Failed: " . $conn->error);
    if (!$conn->query($createUserTable)) die ("Create Table Failed: " . $conn->error);
    $conn->close();
}
?>