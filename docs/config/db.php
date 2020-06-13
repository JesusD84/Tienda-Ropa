<?php
class Database{
    public static function connect() {
        $db = new mysqli('localhost', 'root', 'negativo', 'tienda_master');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}