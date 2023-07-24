<?php
    function connect()
    {
        $host = getenv("DB_HOST");
        $dbname = getenv("DB_NAME");
        $username = getenv('DB_USER');
        $password = getenv('DB_PASSWORD');
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
        $DBH = new PDO("mysql:host=$host;dbname=$dbname",$username, $password,$options);
        return $DBH;
    }

?>