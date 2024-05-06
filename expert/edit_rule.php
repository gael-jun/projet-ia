<?php
    require_once('connect.php');
    $id = $_GET['id'];

    $sql = "SELECT r.id_regles AS id_regle, r.libelle_regles AS libelle, f_conclusion.id_faits AS conclusion, f_premisse.libelle_faits AS premices_regle_courante
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


    $resu = mysqli_query($con, $sql);
    $r=mysqli_fetch_assoc($resu);

    $errno = 0;
    if(isset($_POST['Créer_règle'])){

        if(isset($_POST['libelle']) && isset($_POST['premices']) && isset($_POST['conclusion'])){

            $libelle = $_POST['libelle'];
            $premices = $_POST['premices'];
            $conclusion = $_POST['conclusion'];

            $selectSql = "SELECT * FROM regles";
            $rest = mysqli_query($con, $selectSql);
            while($re=mysqli_fetch_assoc($rest)){ 
                if($re['libelle_regles'] == $libelle) {
                    $errno = 1;
                    
                }
            }

            $sql = "SELECT r.id_regles AS id_regle, r.libelle_regles AS libelle, f_conclusion.libelle_faits AS conclusion, f_premisse.id_faits AS premices_regle_courante
                    FROM regles r
                    JOIN liaison l ON r.id_regles = l.regle
                    JOIN faits f_conclusion ON l.conclusion = f_conclusion.id_faits
                    JOIN faits f_premisse ON l.premisse = f_premisse.id_faits
                    WHERE r.id_regles = $id";

                $res = mysqli_query($con, $sql);

                $premices_regle_courante_array = array();
                $premices_nouvelle_array = array();
                $nom_regle = "";
                $conclusion_regle = "";
            
            while ($row = mysqli_fetch_assoc($res)) {
                $premices_regle_courante = $row['premices_regle_courante'];
                $nom_regle = $row['libelle'];
                $conclusion_regle = $row['conclusion'];
                $premices_regle_courante_array[] = $premices_regle_courante;
            }


            foreach ($premices as $premice_id) {$premices_nouvelle_array[] = $premice_id;}

            if ($errno !=1) {
                $updateSql = "UPDATE `regles` SET libelle_regles='$libelle' WHERE id_regles= '$id' ";
                $req = mysqli_query($con, $updateSql);
            }
            $updateSql2 = "UPDATE `liaison` SET conclusion='$conclusion' WHERE regle= '$id' ";
            $req = mysqli_query($con, $updateSql2);
            
            // Vérifier si toutes les prémices de $premices sont présentes dans $premices_regle_courante_array
            if (empty(array_diff($premices_nouvelle_array, $premices_regle_courante_array))  && empty(array_diff($premices_regle_courante_array, $premices_nouvelle_array)) ) {
                echo "Aucune modification";
            } else {
                // Supprimer les liaisons existantes avec la règle $id
                $deleteSql = "DELETE FROM liaison WHERE regle = '$id'";
                $req = mysqli_query($con, $deleteSql);
            
                // Insérer de nouvelles occurrences de liaison
                foreach ($premices as $premice_id) {
                    

                    $insertSql = "INSERT INTO liaison (regle, premisse, conclusion) VALUES ('$id', '$premice_id', '$conclusion')";
                    $req = mysqli_query($con, $insertSql);
                }
            }

            $_SESSION['message'] = "La mise à jour effectuée avec succès !" ;
            echo "<script> window.location.href='index.php?page=rules';</script>";

        }

    }


?>

<?php
    $regle = "SELECT *FROM `regles` "; $res1 = mysqli_query($con, $regle);
    $fait = "SELECT *FROM `faits` "; $res2 = mysqli_query($con, $fait); $res3 = mysqli_query($con, $fait);
?>
<section>
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h1 mb-0 text-gray-800" style="font-family: 'Gabriola';color: black"><b>Mise à jour des règles</b></h1>
    </div>

    <div class="card o-hidden border-0 shadow-lg my-4 txte" style="color: black; text-decoration: solid;" >
        <div class="container-fluid text-center p-2" style="border-top-right-radius: 10px; border-top-left-radius: 10px; font-family: Bauhaus 93; background-color: rgb(5, 141, 159);color: white;">
            <span><b>Gestion des regles</b></span>
        </div>

        <div class="card-body p-0">
            <div class="row p-2">
                
                <div class="col-xl-5 col-lg-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 text-center">
                            <h6 class="m-0 font-weight-bold text-primary">Modification des regles</h6>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <div class="p-2 text-start">
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
                                                <input type="text" name="libelle" id="libelle" value="<?php echo $r['libelle']; ?>" class="form-control form-control-user" style="font-size:18px;color:black;" required>
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
                                                while ($row = mysqli_fetch_assoc($resultat)) {
                                                    $id_fait = $row['id_faits'];
                                                    $libelle_fait = $row['libelle_faits'];
                                                    $checked = in_array($libelle_fait, $premices_regle_courante_array) ? 'checked' : ''; // Vérifie si la valeur est dans la liste
                                                    echo "<input type='checkbox' name='premices[]' value='$id_fait' $checked>$libelle_fait<br>";
                                                    
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="text-center pt-2  col-sm-4 mb-3 mt-2 mb-sm-0 d-flex ">
                                                <label for="conclusion" style="font-family: 'Berlin Sans FB';font-size:18px;">Conclusion :</label>
                                            </div>
                                            <div class="col-sm-8 mb-3 mt-2 mb-sm-0">
                                            
                                                <select name="conclusion" id="conclusion" class="custom-select form-control" required>
                                                    <?php $x = 0; while($row2 = mysqli_fetch_assoc($res3)){ $x = $x + 1;?> 
                                                        <?php if(($x % 2) == 0) {?>
                                                            <option style=" background : #DBDBDB;" value="<?=$row2['id_faits']?>" <?php if($row2['id_faits'] == $r['conclusion']){echo "selected";} ?> ><?=$row2['libelle_faits']?></option>
                                                        <?php }else{ ?>
                                                            <option value="<?=$row2['id_faits']?>" <?php if($row2['id_faits'] == $r['conclusion']){echo "selected";} ?> ><?=$row2['libelle_faits']?></option>
                                                        <?php }?>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="reset" value="Annuler" class=" btn btn-secondary btn-user btn-block">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="submit" class=" btn btn-user btn-block" name="Créer_règle" value="Sauver" style="background-color: rgb(5, 141, 159);color: black;">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-4"></div>
                                            <div class="col-sm-4 mb-1 mb-sm-0">
                                                <a class="btn btn-light btn-user btn-block" href="?page=rules"><i class='bx bx-arrow-back bx-fade-left' ></i>Retour</a>    
                                            </div>
                                            <div class="col-4"></div>
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
                            <div class="p-2 text-center">
                                <div class="table-responsive">
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
                                        <?php $compt = 0;?>
                                            <?php while($r=mysqli_fetch_assoc($result)){ 
                                                /*$id_regle=$r['regle'];
                                                $id_prem=$r['premisse'];
                                                $id_conclu=$r['conclusion'];*/
                                                $compt = $compt + 1;
                                                ?>
                                                <tr>
                                                    <td><?php echo $compt; ?></td>
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




