<?php

namespace App\Database;

use PDO;

class DB
{

    public static function connect()
    {

        $host = "localhost";
        $db = "tradium";
        $user = "root";
        $pass = "Ninja123!";

        return new PDO(
            "mysql:host=$host;dbname=$db;charset=utf8",
            $user,
            $pass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }
}
