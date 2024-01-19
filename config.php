<?php

try
{
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "udemy";

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
    echo "Error is: ". $e->getMessage();
}

?>