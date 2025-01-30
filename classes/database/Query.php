<?php

namespace App\Classes;

use PDO;

class Query
{
    protected PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll(string $table)
    {
        $statement = $this->db->prepare("SELECT * FROM {$table}");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(string $table, $value, string $columns = 'id', $single = false)
    {
        $value = '%' . $value . '%';

        $columnsArray = explode(',', $columns);
        $whereClause = [];

        foreach ($columnsArray as $column) {
            $whereClause[] = "$column LIKE :value";
        }

        $whereSql = implode(' OR ', $whereClause);

        if ($single) {
            $statement = $this->db->prepare("SELECT * FROM {$table} WHERE $whereSql LIMIT 1");
            $statement->bindValue(':value', $value, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetch(); // Return a single object
        } else {
            // Multiple results
            $statement = $this->db->prepare("SELECT * FROM {$table} WHERE $whereSql");
            $statement->bindValue(':value', $value, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetchAll(); // Return all matching rows as objects
        }
    }

    // Method to check if model name exists
    public function modelExists(string $modelName)
    {
        $statement = $this->db->prepare("SELECT * FROM models WHERE name = :name");
        $statement->bindValue(':name', $modelName, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC); // If exists, return the record
    }

    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->db->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();
    }
    public function update($table, $data, $where)
    {
        $set = '';
        foreach ($data as $key => $value) {
            $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ', ');

        $whereCondition = '';
        foreach ($where as $key => $value) {
            $whereCondition .= "$key = :$key OR ";
        }
        $whereCondition = rtrim($whereCondition, ' OR ');

        $sql = "UPDATE $table SET $set WHERE $whereCondition";
        $stmt = $this->db->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        foreach ($where as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    public function delete(string $table, int $id)
    {
        $sql = sprintf(
            'DELETE FROM %s WHERE id = :id',
            $table
        );

        $this->executePreparedSql($sql, ['id' => $id]);
    }

    protected function executePreparedSql(string $sql, array $parameters)
    {
        try {
            $statement = $this->db->prepare($sql);
            $statement->execute($parameters);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}
