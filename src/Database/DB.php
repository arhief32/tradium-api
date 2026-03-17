<?php

namespace App\Database;

use PDO;

class DB
{

    public static function connect()
    {

        $host = $_ENV['DB_HOST'] ?? 'localhost';
        $db = $_ENV['DB_NAME'] ?? 'db_name';
        $user = $_ENV['DB_USER'] ?? 'root';
        $pass = $_ENV['DB_PASS'] ?? 'pasword';

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
