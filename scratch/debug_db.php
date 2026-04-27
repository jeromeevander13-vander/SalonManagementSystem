<?php
$hosts = ['127.0.0.1', 'localhost', '192.168.100.5'];
foreach ($hosts as $host) {
    try {
        $pdo = new PDO("mysql:host=$host;port=3306", "root", "");
        echo "Connected to $host successfully!\n";
    } catch (PDOException $e) {
        echo "Failed to connect to $host: " . $e->getMessage() . "\n";
    }
}
