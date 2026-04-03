<?php
class ConnexionDB
{
    private static $_dbname = "atelier_db";
    private static $_user = "root";
    private static $_pwd = "root123";
    private static $_host = "localhost";
    private static $_port = 3307;

    private static $_bdd = null;

    private function __construct()
    {
        try {
            self::$_bdd = new PDO(
                "mysql:host=".self::$_host.";port=".self::$_port.";dbname=".self::$_dbname.";charset=utf8",
                self::$_user,
                self::$_pwd,
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getInstance(): ?PDO
    {
        if (!self::$_bdd) {
            new ConnexionDB();
        }
        return self::$_bdd;
    }
}