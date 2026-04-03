<?php
require_once 'Class/ConnexionDB.php';

try {
    $db = ConnexionDB::getInstance();
    echo "Connected to the database!";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}