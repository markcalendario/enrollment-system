<?php

class activitylog {
    public function log($text) {
        $con = connect();

        $logText = getName($_SESSION['id']) . ' ' . $text;

        $stmt = $con->prepare('INSERT INTO log (logtext) VALUES (?)');
        $stmt->bind_param('s', $logText);
        $stmt->execute();
    }
}

function getName($id) {

    $con = connect();

    $stmt = $con->prepare('SELECT fullname FROM user_info WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($fullname);
    $stmt->fetch();
    return $fullname;
}


?>