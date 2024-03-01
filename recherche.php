<?php
$host = 'localhost'; // on définit le nom de l'hôte || we define the name of the host
$db   = 'autocompletion'; // on définit le nom de la base de données || we define the name of the database
$user = 'root'; // on définit le nom d'utilisateur || we define the name of the user
$pass = ''; // on définit le mot de passe || we define the password
$charset = 'utf8mb4'; // on definit le charset pour éviter les problèmes d'encodage || we define the charset to avoid encoding problems

$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; // on se connecte à la base de données || we connect to the database
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // on active les erreurs SQL || we activate SQL errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // on définit le mode de récupération des résultats || we define the mode of retrieving results
    PDO::ATTR_EMULATE_PREPARES   => false, // on désactive l'émulation des requêtes préparées || we disable emulation of prepared queries
];  
$pdo = new PDO($dsn, $user, $pass, $opt);

$search = $_GET['search']; // la variable search est le nom de la variable qui est envoyé par le formulaire dans la page index.php || the search variable is the name of the variable that is sent by the form in the index.php page

$stmt = $pdo->prepare("SELECT * FROM pokemon WHERE name LIKE ? ORDER BY CASE WHEN name LIKE ? THEN 0 ELSE 1 END, name"); // on prépare la requête SQL qui va chercher les pokémons qui ont un nom qui ressemble à la variable search || we prepare the SQL query that will look for pokemons that have a name that looks like the search variable
$stmt->execute(["%$search%", "$search%"]); // on exécute la requête SQL || we execute the SQL query
$results = $stmt->fetchAll(); // on met les résultats dans un tableau || we put the results in an array

foreach ($results as $row) { // on affiche les résultats de la requête SQL || we display the results of the SQL query
    echo '<p><a class = "recherhche_pokemon" href="element.php?id=' . $row['id'] . '">' . $row['name'] . '</a></p>'; // on affiche le nom du pokémon et on met un lien vers la page element.php avec l'id du pokémon || we display the name of the pokémon and put a link to the element.php page with the id of the pokémon
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
