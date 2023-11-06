<?php

define("DB_DSN", "mysql:host=localhost;port=3306;dbname=loginsystem;charset=utf8mb4");
define("DB_USER","root");
define("DB_PASSWORD","");
define("DB_OPTIONS", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

try {
    $pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD, DB_OPTIONS);
} catch (PDOException $e) {
    die("ERROR". $e->getMessage());
}