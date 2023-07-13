<?php
    function connect()
    {
        /* $host = "sql210.byethost12.com";
        $dbname = "b12_34506519_php01";
        $username = getenv('DB_USER');
        $password = getenv('DB_PASS'); */
        $host = 'mysql';
        $dbname = 'tstore';
        $username = 'root';
        $password = 'password';
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
        $DBH = new PDO("mysql:host=$host;dbname=$dbname",$username, $password,$options);
        return $DBH;
    }

?>