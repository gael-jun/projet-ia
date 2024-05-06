<?php

// Création de la connexion
$conn = mysqli_connect("localhost","root","","projet_ia");

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Requête SQL
$sql = "SELECT r.libelle_regles AS libelle, f_conclusion.libelle_faits AS conclusion,
               GROUP_CONCAT(f_premisse.libelle_faits SEPARATOR ',') AS premices_regle_courante
        FROM regles r
        JOIN liaison l ON r.id_regles = l.regle
        JOIN faits f_conclusion ON l.conclusion = f_conclusion.id_faits
        JOIN faits f_premisse ON l.premisse = f_premisse.id_faits
        GROUP BY r.libelle_regles, f_conclusion.libelle_faits";

// Exécution de la requête
$result = $conn->query($sql);

if ($result === false) {
    die("Erreur lors de l'exécution de la requête : " . $conn->error);
}

// Formatage des résultats en listes
$listes = [];
while ($row = $result->fetch_assoc()) {
    $conclusion = $row["conclusion"];
    $premices = explode(",", $row["premices_regle_courante"]);
    $premices = array_map(function($premice) {
        return str_replace(" ", "_", $premice);
    }, $premices);
    $premices = array_map(function($premice) {
        return str_replace(">", "SUP", $premice);
    }, $premices);
    $liste = array_merge([$conclusion], $premices);
    $listes[] = $liste;
}

// Stockage des listes dans une chaîne de caractères
$listes_scheme = "";
foreach ($listes as $liste) {
    $liste_scheme = implode(",", $liste) ;
    $listes_scheme .= "!" . $liste_scheme;
}

$listes_scheme = str_replace(" ", "_", $listes_scheme);
$listes_scheme = str_replace(">", "SUP", $listes_scheme);
$listes_scheme = ltrim($listes_scheme, "!");

$conn->close();


?>

