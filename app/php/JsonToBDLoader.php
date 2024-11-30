<?php

namespace test_task;

use mysqli;

class JsonToBDLoader
{
    private mysqli $db;
    private string $dbName;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    public function __destruct()
    {
        if ($this->db) {
            $this->db->close();
        }
    }


    private function prepareBaseSQLStatement($columnNames, $tableName)
    {
        $sql = "INSERT INTO $tableName(";
        for ($i = 0; $i < count($columnNames); $i++) {
            if (!(($y = $i + 1) < count($columnNames))) {
                $sql .= "$columnNames[$i])";
            } else {
                $sql .= "$columnNames[$i],";
            }
        }

        $sql .= " VALUES (";

        for ($i = 0; $i < count($columnNames); $i++) {
            if (!(($y = $i + 1) < count($columnNames))) {
                $sql .= "?)";
            } else {
                $sql .= "?,";
            }
        }
        return $sql;
    }

    private function loadJsonFromURL(string $jsonURL)
    {
        $json = file_get_contents($jsonURL);
        return json_decode($json);
    }

    private function getColumnNames($slice)
    {
        return array_keys(get_object_vars($slice));
    }

    private function getJsonName($url)
    {
        return end(explode('/', $url));
    }

    public function uploadToDB($url)
    {
        $tableName = $this->getJsonName($url);
        $data = $this->loadJsonFromURL($url);

        $columnNames = $this->getColumnNames($data[0]);
        $sqlBase = $this->prepareBaseSQLStatement($columnNames, $tableName);

        foreach ($data as $key) {
            $varArr = [];
            foreach ($key as $value) {
                $varArr[] = $value;
            }

            $stmt = $this->db->prepare($sqlBase);
            $stmt->execute($varArr);
        }
    }
}
