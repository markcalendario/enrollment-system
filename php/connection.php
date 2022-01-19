<?php 

function connect() {
    static $conn;

    if ($conn == null) {
        $conn = mysqli_connect("localhost", "root", "", "enrollment_system");
    }

    if ($conn) {
        return $conn;
    } else {
        header("Location: .."); 
    }



}


?>