<?php
// test_bdd.php

// Informations de connexion à la base de données
$servername = "data";  // Nom du conteneur SQL
$username = "root";
$password = "rootpassword";
$dbname = "testdb";

// Établir une connexion avec la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion pour capturer les erreurs
if ($conn->connect_error) {
    die("Erreur lors de la connexion à la base de données: " . $conn->connect_error);
}

// Création de la table si elle n'existe pas déjà dans la base
$sql = "CREATE TABLE IF NOT EXISTS test_table (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
)";
$conn->query($sql);

// Insertion d'une nouvelle ligne avec un nom aléatoire
$sql = "INSERT INTO test_table (name) VALUES ('Nom " . rand(1, 100) . "')";
$conn->query($sql);

// Sélectionner et afficher les données présentes dans la table
$sql = "SELECT * FROM test_table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Données disponibles dans la table:</h1><ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>ID: " . $row["id"] . " - Nom: " . $row["name"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "Aucune donnée trouvée.";
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
