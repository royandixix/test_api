<?php
class Database
{
    private $conn;
    private $tableName;
    private $column = [];
    public function __construct()
    {
        $this->conn = $this->setConnection();
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }
    public function setColumn($column)
    {
        $this->column = $column;
    }

    protected function setConnection()
    {
        try {
            $host = getenv('DB_HOST');
            $user = getenv('DB_USER');
            $pass = getenv('DB_PASSWORD');
            $db = getenv('DB_NAME');
            $port = getenv('DB_PORT');
            $conn = new PDO("mysql:host=$host;dbname=$db;port=$port", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function qry($query, $params = array())
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }
    public function get($params = array())
    {
        $column = implode(",", $this->column);  // Menggabungkan array kolom
        $query = "SELECT $column FROM {$this->tableName}";
        $paramValue = [];

        // Cek apakah ada parameter yang dimasukkan
        if (!empty($params)) {
            $query .= " WHERE ";  // Hilangkan 1=1
            $conditions = [];
            foreach ($params as $key => $value) {
                $conditions[] = "{$key} = ?";  // Tambahkan syarat untuk setiap parameter
                array_push($paramValue, $value);
            }
            // Gabungkan kondisi dengan " AND "
            $query .= implode(" AND ", $conditions);
        }

        // Jalankan query
        return $this->qry($query, $paramValue);
    }

    public function insertData($data = array())
    {
        if (empty($data)) {
            return false;
        }
        $columnValue = [];
        $kolom = [];
        $param = [];
        foreach ($data as $key => $value) {
            array_push($kolom, $key);
            array_push($columnValue, $value);  // Perbaiki ini
            array_push($param, "?");
        }
        $kolom = implode(",", $kolom);
        $param = implode(",", $param);
        $query = "INSERT INTO {$this->tableName} ($kolom) VALUES ($param)";
        return $this->qry($query, $columnValue);
    }

    public function updateData($data = array(), $param = array())
    {
        if (empty($data)) {
            return false;
        }
        $columnValue = [];
        $kolom = [];
        $query = "UPDATE {$this->tableName}";
        foreach ($data as $key => $value) {
            array_push($kolom, $key . "?");
            array_push($columnValue, $value);
        }
        $kolom = implode(",", $kolom);
        $query = $query . "SET $kolom WHERE 1=1";
        $whereColumn = [];
        foreach ($param as $key => $value) {
            array_push($whereColumn, "AND {$key} = ?");
            array_push($columnValue, $value);
        }
        $whereColumn = implode(", ", $whereColumn);
        $query = $query . $whereColumn;
    }

    public function deleteData($param = array())
    {
        if (empty($param)) {
            return false;
        }
        $query = "DELETE FROM {$this->tableName} WHERE 1=1";;
        $whereColumn = [];
        $columnValue = [];
        foreach ($param as $key => $value) {
            array_push($whereColumn, "AND {$key} =?");
            array_push($columnValue, $value);
        }

        $whereColumn = implode(", ", $whereColumn);
        $query = $query . $whereColumn;
        return $this->qry($query, $columnValue);
    }
    
}
