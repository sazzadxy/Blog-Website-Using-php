<?php
require_once('DB.php');

    $db = new DB;

    echo $db->isConnected() ? 'Database Connected': 'Databse Not Connected';
    if (!$db->isConnected()) {
        echo $db->getError();
        die("Connection Can't Established");
    }







?>