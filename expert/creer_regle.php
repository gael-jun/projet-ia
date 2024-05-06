<?php


$con = mysqli_connect("localhost","root","","projet_ia");

    // Récupérer les données du formulaire
    $libelle = $_POST['libelle'];
    $premices = $_POST['premices'];
    $conclusion = $_POST['conclusion'];

    // Insérer le libellé de la règle dans la table "regles"
    // et récupérer l'identifiant de la règle créée
    $sql = "INSERT INTO regles (libelle_regles) VALUES ('$libelle')";
    // Exécuter la requête SQL et vérifier si elle s'est exécutée avec succès
    $result = mysqli_query($con, $sql);
    // Récupérer l'identifiant de la règle insérée
    $id_regle = mysqli_insert_id($con); // Assurez-vous d'avoir une connexion valide à la base de données

    // Insérer les prémices dans la table "liaison"
    foreach ($premices as $premice_id) {
        $sql = "INSERT INTO liaison (regle, premisse, conclusion) VALUES ('$id_regle', '$premice_id', '$conclusion')";
        // Exécuter la requête SQL pour chaque prémice
        $result = mysqli_query($con, $sql);
    }

    // Rediriger vers la page "rules.php"
 // Assurez-vous d'appeler exit() après la redirection pour terminer l'exécution du script
    
    // Vérifier si les opérations se sont déroulées avec succès et afficher un message approprié


?>

<section>
    <?php header("Location: index.php?page=rules");
exit; ?>
</section>






