<?php

require './env/setting.php';

class PdoWrapper
{
    private static $instance = null;
    private static $pdo = null;

    private function __construct()
    {
    }

    private function init()
    {
        $pdo = null;
        $connection = getConnectionInfo();

        $dsn = $connection->dsn;
        $username = $connection->username;
        $password = $connection->password;

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            $pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }

        return $pdo;
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get()
    {
        if (!isset(self::$pdo)) {
            self::$pdo = $this->init();
        }

        return self::$pdo;
    }
}