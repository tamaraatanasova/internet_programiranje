<?php
namespace App\Classes;

require_once __DIR__.'/../../core/db.config.php';

use PDO;
use PDOException;
class Database
{
    private ?PDO $connection = null;

    public function __construct(){
        try {
            $this->connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
        } catch (PDOException $e) {
            die("Database connection failed. ");
        }
    }

    public function getConnection(): ?PDO {
        return $this->connection;
    }

    public function closeConnection(): void {
        $this->connection = null;
    }
}