<?php
    
    $mysqli = new mysqli('localhost', 'root', '', 'ejemplo');

    if($mysqli->connect_error){
        die("error: ". $mysqli->connect_error);
    }

?>