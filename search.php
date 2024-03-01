<?php
$host = 'localhost'; // on définit le nom de l'hôte || we define the name of the host
$db   = 'autocompletion'; // on définit le nom de la base de données || we define the name of the database
$user = 'root'; // on définit le nom d'utilisateur || we define the name of the user
$pass = ''; // on définit le mot de passe || we define the password
$charset = 'utf8mb4'; // on definit le charset pour éviter les problèmes d'encodage || we define the charset to avoid encoding problems

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // on définit le mode de récupération des résultats || we define the mode of retrieving results
    PDO::ATTR_EMULATE_PREPARES   => false, // on désactive l'émulation des requêtes préparées || we disable emulation of prepared queries
];
$pdo = new PDO($dsn, $user, $pass, $opt); // on crée une nouvelle instance de PDO qui représente une connexion à la base de données || we create a new instance of PDO which represents a connection to the database

$term = $_GET['term']; // la variable term est le nom de la variable qui est envoyé par le script.js || the term variable is the name of the variable that is sent by the script.js script

$stmt = $pdo->prepare("SELECT * FROM pokemon WHERE name LIKE ? ORDER BY CASE WHEN name LIKE ? THEN 0 ELSE 1 END, name"); // on prépare la requête SQL qui va chercher les pokémons qui ont un nom qui ressemble à la variable term || we prepare the SQL query that will look for pokemons that have a name that looks like the term variable
$stmt->execute(["%$term%", "$term%"]); // on exécute la requête SQL || we execute the SQL query
$results = $stmt->fetchAll(); // on met les résultats dans un tableau || we put the results in an array

$data = []; // on crée un tableau vide qui va contenir les résultats de la requête SQL || we create an empty array that will contain the results of the SQL query
foreach ($results as $row) {
    $data[] = ['label' => $row['name'], 'value' => $row['name'], 'id' => $row['id']]; // on met les résultats dans le tableau || we put the results in the table
}

echo json_encode($data); // on renvoie le tableau en format JSON || we return the table in JSON format
?>