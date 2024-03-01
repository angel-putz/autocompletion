<?php
$host = 'localhost'; // on définit le nom de l'hôte || we define the name of the host
$db   = 'autocompletion'; // on définit le nom de la base de données || we define the name of the database
$user = 'root'; // on définit le nom d'utilisateur || we define the username
$pass = ''; // on définit le mot de passe || we define the password
$charset = 'utf8mb4'; // on definit le charset pour éviter les problèmes d'encodage || we define the charset to avoid encoding problems

$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; // on se connecte à la base de données || we connect to the database
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$id = $_GET['id']; // la variable id est le nom de la variable qui est envoyé par le lien dans la page recherche.php || the variable id is the name of the variable that is sent by the link in the search.php page

$stmt = $pdo->prepare("SELECT * FROM pokemon WHERE id = ?"); // on prépare la requête SQL qui va chercher les informations du pokémon qui a l'id de la variable id || we prepare the SQL request which will look for the information of the pokémon which has the id of the variable id
$stmt->execute([$id]); // on exécute la requête SQL || we execute the SQL request
$result = $stmt->fetch(); // on met les résultats dans un tableau || we put the results in a table



echo '<h1 class = "nom_pokemon">' . $result['name'] . '</h1> <br />'; // on affiche le nom du pokémon || we display the name of the pokémon
echo '<p class = "type_pokemon">' . $result['type'] . '</p>'; // on affiche le type du pokémon || we display the type of the pokémon
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