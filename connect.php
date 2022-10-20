<?php
    $host = "localhost";
    $user = "root";
    $pwd = "";
    $db = "bondscriptDB";

    $conn = new mysqli ($host, $user, $pwd, $db);

    if($conn->connect_error)
        die("Connection Failed: ".$conn->connect_error);

?>