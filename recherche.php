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

$search = $_GET['search'];

$stmt = $pdo->prepare("SELECT * FROM pokemon WHERE name LIKE ?");
$stmt->execute(["%$search%"]);
$results = $stmt->fetchAll();

foreach ($results as $row) {
    echo '<a href="element.php?id=' . $row['id'] . '">' . $row['name'] . ', ' . $row['type'] . '</a><br>';
}
?>