<?php
$host = 'localhost';
$db   = 'autocompletion';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM pokemon WHERE id = ?");
$stmt->execute([$id]);
$result = $stmt->fetch();

echo 'Name: ' . $result['name'] . '<br>';
echo 'type: ' . $result['type'] . '<br>';
?>