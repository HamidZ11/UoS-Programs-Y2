<?php
require_once '../Models/Database.php';

try {
    $db = Database::getInstance();
    $db->exec("
        CREATE TABLE IF NOT EXISTS assignments (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            module TEXT NOT NULL,
            title TEXT NOT NULL,
            description TEXT,
            due_date TEXT NOT NULL,
            status TEXT DEFAULT 'To Do'
        )
    ");
    echo '✅ Database and table created successfully!';
} catch (PDOException $e) {
    echo '❌ Error: ' . $e->getMessage();
}