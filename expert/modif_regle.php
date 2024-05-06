<?php


$con = mysqli_connect("localhost","root","","projet_ia");

    // Récupérer les données du formulaire
    $libelle = $_POST['libelle'];
    $premices = $_POST['premices'];
    $conclusion = $_POST['conclusion'];
    $id = $_POST['Créer_règle'];


    $sql = "SELECT r.id_regles AS id_regle, r.libelle_regles AS libelle, f_conclusion.libelle_faits AS conclusion,
                                    f_premisse.id_faits AS premices_regle_courante
                                FROM regles r
                                JOIN liaison l ON r.id_regles = l.regle
                                JOIN faits f_conclusion ON l.conclusion = f_conclusion.id_faits
                                JOIN faits f_premisse ON l.premisse = f_premisse.id_faits
                                WHERE r.id_regles = $id";


        
        $res = mysqli_query($con, $sql);

        $premices_regle_courante_array = array();

// Parcourir les résultats et stocker les valeurs dans le tableau
while ($row = mysqli_fetch_assoc($res)) {
    $premices_regle_courante = $row['premices_regle_courante'];
    $premices_regle_courante_array[] = $premices_regle_courante;
}
    print_r($premices_regle_courante_array);
    // Insérer le libellé de la règle dans la table "regles"
    // et récupérer l'identifiant de la règle créée
    
    while ($row = mysqli_fetch_assoc($res)) {
        $premices_regle_courante = $row['premices_regle_courante'];
        $premices_regle_courante_array[] = $premices_regle_courante;
    }
    
    // Vérifier si toutes les prémices de $premices sont présentes dans $premices_regle_courante_array
    if (empty(array_diff($premices, $premices_regle_courante_array))) {
        echo "Aucune action requise. Les prémices correspondent.";
    } else {
        // Supprimer les liaisons existantes avec la règle $id
        $deleteSql = "DELETE FROM liaison WHERE regle = '$id'";
        mysqli_query($con, $deleteSql);
    
        // Insérer de nouvelles occurrences de liaison
        foreach ($premices as $premice_id) {
            $insertSql = "INSERT INTO liaison (regle, premisse, conclusion) VALUES ('$id', '$premice_id', '$conclusion')";
            mysqli_query($con, $insertSql);
        }
    
        echo "Les liaisons ont été mises à jour avec succès.";
    }
?>

