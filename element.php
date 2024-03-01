<?php
$host = 'localhost'; // on définit le nom de l'hôte || we define the name of the host
$db   = 'autocompletion'; // on définit le nom de la base de données || we define the name of the database
$user = 'root'; // on définit le nom d'utilisateur || we define the username
$pass = ''; // on définit le mot de passe || we define the password
$charset = 'utf8mb4'; // on definit le charset pour éviter les problèmes d'encodage || we define the charset to avoid encoding problems

$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; // on se connecte à la base de données
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$id = $_GET['id']; // la variable id est le nom de la variable qui est envoyé par le lien dans la page recherche.php

$stmt = $pdo->prepare("SELECT * FROM pokemon WHERE id = ?"); // on prépare la requête SQL qui va chercher les informations du pokémon qui a l'id de la variable id
$stmt->execute([$id]); // on exécute la requête SQL
$result = $stmt->fetch(); // on met les résultats dans un tableau



echo '<h1 class = "nom_pokemon">' . $result['name'] . '</h1> <br />'; // on affiche le nom du pokémon
echo '<p class = "type_pokemon">' . $result['type'] . '</p>'; // on affiche le type du pokémon
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
</body>
</html>