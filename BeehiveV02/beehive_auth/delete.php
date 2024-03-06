<?php
$host = "localhost";
$username = "root";
$password = "";
$DBname = "beehive";

$bdd = mysqli_connect($host, $username, $password, $DBname);

if (mysqli_connect_errno()) {
    die("Erreur de connexion: " . mysqli_connect_error());
}

if (isset($_GET['Id'])) {
    $id_del = $_GET['Id'];
    $sql = "DELETE FROM users WHERE Id = $id_del"; 
    $resultat = mysqli_query($bdd, $sql);
    if ($resultat) { 
        header("Location: admin.php");
        exit(); 
    } else {
        die("Erreur lors de la suppression de l'événement : " . mysqli_error($bdd));
    }
}

// Redirection vers index.html si l'ID n'est pas défini
header("Location: admin.php");
exit(); // Sortir du script après la redirection pour éviter l'exécution du reste du code
?>