<?php
$con = mysqli_connect("localhost","root","","projet_ia");

$errno = 0;
if(isset($_POST['Créer_règle'])){

    if(isset($_POST['libelle']) && isset($_POST['premices']) && isset($_POST['conclusion'])){

        // Récupérer les données du formulaire
    $libelle = $_POST['libelle'];
    $premices = $_POST['premices'];
    $conclusion = $_POST['conclusion'];

    $selectSql = "SELECT * FROM regles";
    $rest = mysqli_query($con, $selectSql);
    while($re=mysqli_fetch_assoc($rest)){ 
        if($re['libelle_regles'] == $libelle) {
            $errno = 1;
            $error = "Ce libellé est déjà utilisé";
        }
    }


    if ($errno != 1) {
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
    }

    // Rediriger vers la page "rules.php"
 // Assurez-vous d'appeler exit() après la redirection pour terminer l'exécution du script
    
    // Vérifier si les opérations se sont déroulées avec succès et afficher un message approprié
    }
}
?>

<section>
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h1 mb-0 text-gray-800" style="font-family: 'Gabriola';color: black"><b>Enregistrement des regles</b></h1>
    </div>
    <div class="mr-0 d-sm-flex align-items-center justify-content-between mb-0">
            <h4 class="h5 mb-0 my-0  text-gray-800" style="font-family: 'Gabriola';color: black">
            <b>Pour une règle Ri qui est un diagnostic "SI symptome1 ET symptome2 ALORS maladie", symptome1 et symptome2 sont les prémices de la règle et maladie est la conclusion.
                <br>
                Pour une règle Rj qui est un traitement "SI maladie ALORS médicament", maladie est la prémice et médicament est la conclusion. 
                S'il y'a d'autres médicaments pour cette maladie, il faut répéter pour chacun des autres médicaments, l'opération de création de règle précédemment décrite.

            </b></h4>

    </div>

    <div class="card o-hidden border-0 shadow-lg my-2 txte" style="color: black; text-decoration: solid;" >
        <div class="container-fluid text-center p-2" style="border-top-right-radius: 10px; border-top-left-radius: 10px; font-family: Bauhaus 93; background-color: rgb(5, 141, 159);color: white;">
            <span><b>Gestion des regles</b></span>
        </div>
        

        <div class="card-body p-0">
            <div class="row p-2">

                <div class="col-xl-5 col-lg-6">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3 text-center">
                            <h6 class="m-0 font-weight-bold text-primary">Création des regles</h6>
                        </div>
                        <div class="card-body mb-0">
                            <div class="">
                                <div class="px-2 text-start">

                                    <?php if(isset($error)): ?>
                                        <div class="pb-2">
                                            <strong class='me-auto text-danger text-center' style="font-family:'Patua One';"><?php echo $error ;?></strong>
                                        </div>
                                    <?php endif; ?>
                                    <form method="POST" action="">

                                        <div class="form-group row">
                                            <div class="text-center pt-2  col-sm-4 mb-3 mt-2 mb-sm-0 d-flex ">
                                                <label for="libelle" style="font-family: 'Berlin Sans FB';font-size:18px;">Nom de la règle :</label>
                                            </div>
                                            <div class="col-sm-8 mb-3 mt-2 mb-sm-0">
                                                <input type="text" name="libelle" id="libelle" class="form-control form-control-user" style="font-size:18px;color:black;" required>
                                            </div>
                                        </div>
                                        
                                        <style>
                                        .scrollable-container {
                                            height: 175px; /* Hauteur fixe du conteneur */
                                            overflow-y: auto; /* Activer la barre de défilement verticale */
                                            border: 1px solid #ccc; /* Bordure facultative pour le cadre */
                                            /* Espacement intérieur facultatif pour le cadre */
                                            width: 61%; 
                                            
                                        }
                                        </style>

                                        
                                        <div class="form-group row">
                                            <div class="text-center pt-2  col-sm-4 mb-3 mt-2 mb-sm-0 d-flex ">
                                                <label for="premices[]" style="font-family: 'Berlin Sans FB';font-size:18px;">Prémices :</label>
                                            </div>
                                            
                                            <div class="col-sm-8 mb-3 mt-2 mb-sm-0 ml-3 form-control scrollable-container">
                                                <?php
                                                // Récupérer les faits depuis la table "faits"
                                                // Assurez-vous d'avoir une connexion valide à la base de données
                                                $sql = "SELECT id_faits, libelle_faits FROM faits";
                                                // Exécuter la requête SQL et récupérer les résultats
                                                $resultat = mysqli_query($con, $sql);
                                                // Afficher les options du menu déroulant pour les prémices
                                                $checkboxCount = 0; // Compteur pour vérifier si au moins une case a été cochée
                                                $t = 0;
                                                while ($row = mysqli_fetch_assoc($resultat)) {
                                                    $t = $t +1;
                                                    $id_fait = $row['id_faits'];
                                                    $libelle_fait = $row['libelle_faits'];
                                                    if(($t % 2) == 1){
                                                        echo "<input type='checkbox' name='premices[]' value='$id_fait' onchange='updateCheckboxCount(this)'> $libelle_fait<br>";
                                                    }else{
                                                        echo "<div class=\"\" style=\" background : #DBDBDB; \"><input type='checkbox' name='premices[]' value='$id_fait' onchange='updateCheckboxCount(this)'> $libelle_fait </div>";
                                                    }
                                                    
                                                }
                                                ?>

                                                <script>
                                                            function updateCheckboxCount(checkbox) {
                                                                if (checkbox.checked) {
                                                                    checkboxCount++;
                                                                } else {
                                                                    checkboxCount--;
                                                                }

                                                                // Activer ou désactiver la soumission du formulaire en fonction du nombre de cases cochées
                                                                var submitButton = document.getElementById('submit-button');
                                                                submitButton.disabled = true;
                                                            }
                                                        </script>
                                            </div>
                                        </div>

                                        
                                        

                                        <div class="form-group row">
                                            <div class="text-center pt-2  col-sm-4 mb-3 mt-2 mb-sm-0 d-flex ">
                                                <label for="conclusion" style="font-family: 'Berlin Sans FB';font-size:18px;">Conclusion :</label>
                                            </div>
                                            <div class="col-sm-8 mb-3 mt-2 mb-sm-0">
                                                <select name="conclusion" id="conclusion" class="custom-select form-control" required>
                                                    <?php
                                                        // Afficher les options du menu déroulant pour la conclusion
                                                        mysqli_data_seek($resultat, 0); // Réinitialiser le pointeur des résultats
                                                        
                                                        $x = 0;
                                                        while ($row = mysqli_fetch_assoc($resultat)) { $x = $x + 1 ;
                                                            $id_fait = $row['id_faits'];
                                                            $libelle_fait = $row['libelle_faits'];
                                                            if(($x % 2) == 0){
                                                                echo "<option value='$id_fait' style=\" background : #DBDBDB; \">$libelle_fait</option>";
                                                            }else{
                                                                echo "<option value='$id_fait'>$libelle_fait</option>";
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row mb-2">
                                            <div class="col-sm-6 mb-0 mb-sm-0">
                                                <input type="reset" value="Annuler" class=" btn btn-secondary btn-user btn-block">
                                            </div>
                                            <div class="col-sm-6">
                                                <input id="submit-button" type="submit" class=" btn btn-user btn-block" name="Créer règle" value="Sauver" style="background-color: rgb(5, 141, 159);color: black;" >
                                            </div>
                                        </div>

                                    </form>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7 col-lg-8">
                    <?php

                                        // Création de la connexion
                        $conn = mysqli_connect("localhost","root","","projet_ia");

                        // Vérification de la connexion
                        if ($conn->connect_error) {
                            die("Erreur de connexion à la base de données : " . $conn->connect_error);
                        }

                        // Requête SQL
                        $sql = "SELECT r.id_regles AS id, r.libelle_regles AS libelle, f_conclusion.libelle_faits AS conclusion,
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
                        $ReadSql = "SELECT *FROM `liaison` ";
                        $liaison = mysqli_query($con, $ReadSql);
                    ?>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 text-center">
                            <h6 class="m-0 font-weight-bold text-primary">Base des regles</h6>
                        </div>
                        <div class="card-body">
                            <div class="px-2 pb-2 pt-1 text-center">
                                <div class="table-responsive pt-2 pb-3">
                                    <table class="table table-striped mt-3" id="dataTable" width="100%">
                                        <colgroup>
                                            <col width="5%">
                                            <col width="15%">
                                            <col width="30%">
                                            <col width="30%">
                                            <col width="20%">
                                        </colgroup>
                                        <thead style="font-family: 'Patua One';" >
                                            <tr>
                                                <th>#</th>
                                                <th>Regles</th>
                                                <th>Premices</th>
                                                <th>Conclusion</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php $compteur = 0;?>
                                            <?php while($r=mysqli_fetch_assoc($result)){ 
                                                /*$id_regle=$r['regle'];
                                                $id_prem=$r['premisse'];
                                                $id_conclu=$r['conclusion'];*/
                                                $compteur = $compteur + 1;
                                                ?>
                                                <tr>
                                                    <td><?php echo $compteur; ?></td>
                                                    <td>
                                                        <span><?=$r['libelle']?></span>
                                                    </td>
                                                    <td>
                                                        <span><?=$r['premices_regle_courante']?></span>
                                                    </td>
                                                    <td>
                                                        <span><?=$r['conclusion']?></span>
                                                    </td>
                                                    <td>
                                                        <div class="text-center d-flex justify-content-center">
                                                            <a href="?page=edit_rule&id=<?php echo $r['id']; ?>" title="editer">
                                                                <i class="bx bx-edit bx-md" ></i>
                                                            </a>
                                                            <a href="delete_detail.php?id=<?=$r['id'];?>" title="supprimer">
                                                                <i class="bx bx-message-square-x bx-md" style="color:red"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>