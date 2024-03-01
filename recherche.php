<?php
$host = 'localhost'; // on définit le nom de l'hôte
$db   = 'autocompletion'; // on définit le nom de la base de données
$user = 'root'; // on définit le nom d'utilisateur
$pass = ''; // on définit le mot de passe
$charset = 'utf8mb4'; // on definit le charset pour éviter les problèmes d'encodage

$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; // on se connecte à la base de données
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // on active les erreurs SQL
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // on définit le mode de récupération des résultats
    PDO::ATTR_EMULATE_PREPARES   => false, // on désactive l'émulation des requêtes préparées
]; 
$pdo = new PDO($dsn, $user, $pass, $opt);

$search = $_GET['search']; // la variable search est le nom de la variable qui est envoyé par le formulaire

$stmt = $pdo->prepare("SELECT * FROM pokemon WHERE name LIKE ? ORDER BY CASE WHEN name LIKE ? THEN 0 ELSE 1 END, name"); // on prépare la requête SQL qui va chercher les pokémons qui ont un nom qui ressemble à la variable search 
$stmt->execute(["%$search%", "$search%"]); // on exécute la requête SQL
$results = $stmt->fetchAll(); // on met les résultats dans un tableau

foreach ($results as $row) { // on affiche les résultats 
    echo '<p><a class = "recherhche_pokemon" href="element.php?id=' . $row['id'] . '">' . $row['name'] . '</a></p>'; // on affiche le nom du pokémon et on met un lien vers la page element.php avec l'id du pokémon
}
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
