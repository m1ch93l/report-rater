<?php

class Database {
    private $config = [
        'host'   => 'localhost',
        'user'   => 'root',
        'pass'   => '',
        'dbname' => 'report-rater',
    ];

    private $conn;

    public function connect() {
        $dsn     = "mysql:host={$this->config['host']};dbname={$this->config['dbname']}";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->conn = new PDO($dsn, $this->config['user'], $this->config['pass'], $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

    public function getConnection() {
        if (!$this->conn) {
            $this->connect();
        }
        return $this->conn;
    }
}
