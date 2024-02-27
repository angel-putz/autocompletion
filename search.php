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

$term = $_GET['term'];

$stmt = $pdo->prepare("SELECT * FROM pokemon WHERE name LIKE ? ORDER BY CASE WHEN name LIKE ? THEN 0 ELSE 1 END, name");
$stmt->execute(["%$term%", "$term%"]);
$results = $stmt->fetchAll();

$data = [];
foreach ($results as $row) {
    $data[] = ['label' => $row['name'], 'value' => $row['name'], 'id' => $row['id']];
}

echo json_encode($data);
?>