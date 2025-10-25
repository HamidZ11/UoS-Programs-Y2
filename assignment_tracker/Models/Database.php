<?php
/**
 * Database connection for Assignment Tracker
 */
class Database
{
    private static $dbInstance = null;

    public static function getInstance()
    {
        if (self::$dbInstance === null) {
            $dbPath = __DIR__ . '/../Database/assignments.db';
            self::$dbInstance = new PDO('sqlite:' . $dbPath);
            self::$dbInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$dbInstance;
    }
}