<?php
    require_once('connect.php');
    require_once('selection_regle.php');

    $valeur_de_verite =  "";
    $fait = "SELECT *FROM `faits` "; $res = mysqli_query($con, $fait);
    $hypothese = "";

    putenv('PATH=' . $_SERVER['PATH']);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['checkboxes']) && is_array($_POST['checkboxes'])) {
            $values = str_replace(">", "SUP", (str_replace(" ", "_", implode("!", $_POST['checkboxes']))));
            //echo $values;
        }

        if (isset($_POST['hypothese'])) {
            $hypothese = $_POST['hypothese'];
        }elseif (isset($_POST['hypotheses'])) {
            $hypothese = $_POST['hypotheses'];
        }


        $hypothes = str_replace(" ", "_", $hypothese);
        $hypothes = str_replace(">", "SUP", $hypothes);

        $command = "racket projet.rkt $hypothes $values $listes_scheme > cmdout.txt";
    
        exec($command);



        $myfile = fopen("cmdout.txt", "r") or die("Unable to open file!");

        $solution = fread($myfile,filesize("cmdout.txt") - 1);

        fclose($myfile);

        if ($solution == "#f"){
            $valeur_de_verite =  "#f";
        }else{
            $valeur_de_verite =  "#t";
        }

        
    }
?>
<section>
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h1 mb-0 text-gray-800" style="font-family: 'Gabriola';color: black"><b>Systeme Expert</b></h1>
    </div>

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3 text-center">
                    <h6 class="m-0 font-weight-bold text-primary">Reponse du Moteur d'Inference</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body" style="font-family:'Cambria';">
                    <form action="" method="post">

                        <div class="row p-2">
                            <div class="col-xl-6 col-lg-7">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 text-center">
                                        <h6 class="m-0 font-weight-bold text-primary">Hypothèse</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="hypothese" value="Paludisme">
                                            <label class="form-check-label">
                                                Paludisme
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="hypothese" value="Diabète">
                                            <label class="form-check-label">
                                            Diabète
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="hypothese" value="COVID19">
                                            <label class="form-check-label">
                                                COVID19
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="hypothese" value="Grippe">
                                            <label class="form-check-label">
                                                Grippe
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="hypothese" value="Carries dentaires">
                                            <label class="form-check-label">
                                            Carries dentaires
                                            </label>
                                        </div>
                                        
                                    </div>
                                    <input class = "mx-2 my-2" type="text" name="hypotheses">
                                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h6 class="h6 mb-0 mx-2 text-gray-800" style="font-family: 'Gabriola';color: black"><b>Ici vous devez cochez OU écrire une hypothèse. Si vous faites les deux c'est l'hypothèse cochée qui sera prise en compte</b></h6>

    </div>
                                </div>
                            </div>

                            <style>
                                        .scrollable-container {
                                            height: 253px; /* Hauteur fixe du conteneur */
                                            overflow-y: auto; /* Activer la barre de défilement verticale */
                                            border: 1px solid #ccc; /* Bordure facultative pour le cadre */
                                            /* Espacement intérieur facultatif pour le cadre */
                                            
                                            
                                        }
                            </style>


                            <div class="col-xl-6 col-lg-7">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 text-center">
                                        <h6 class="m-0 font-weight-bold text-primary">Faits Initiaux</h6>
                                    </div>
                                    <div class="card-body scrollable-container">

                                            <?php $t = 0; while($r=mysqli_fetch_assoc($res)){ $t = $t+1;?>

                                                <?php if(($t % 2) == 1){?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="checkboxes[]" value="<?=$r['libelle_faits']?>">
                                                        <label class="form-check-label">
                                                            <?php echo $r['libelle_faits']; ?>
                                                        </label>
                                                    </div>
                                                <?php }else{ ?>
                                                    <div class="form-check bg-light">
                                                        <input class="form-check-input" type="checkbox" name="checkboxes[]" value="<?=$r['libelle_faits']?>">
                                                        <label class="form-check-label">
                                                            <?php echo $r['libelle_faits']; ?>
                                                        </label>
                                                    </div>
                                                <?php } ?>

                                            <?php }?> 

                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <a href="#" class=" btn btn-secondary btn-user btn-block">Annuler</a>  
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class=" btn btn-user btn-block" style="background-color: rgb(5, 141, 159);color: black;">Soumettre</button>
                            </div>
                        </div>

                    </form>
                </div>


                <div class="card-footer">
                   <div class=" form-group row d-sm-flex align-items-center justify-content-between">
                        <div class="col-sm-2 mb-3 mb-sm-0">
                            <a class=" btn btn-primary btn-user btn-block" style="font-family:'Berlin Sans FB';">RESULTAT</a>  
                        </div>

                        <?php if($valeur_de_verite == "#f"){ ?>
                        <div class="col-sm-10">
                            <span class="text-center h5" style="font-family:'Berlin Sans FB';">L'hypothèse <?php echo "<span class=\"text-center h3 text-danger\" style=\"font-family:'Berlin Sans FB';\"> $hypothese </span>" ?> n'a pas été prouvé !!! nous vous invitons à verifier une autre hypothèse</span>
                        </div>
                        <?php } elseif($valeur_de_verite == ""){ ?>
                            <div class="col-sm-10">
                            <span class="text-center h5" style="font-family:'Berlin Sans FB';">Vous n'avez pas encore interrogé le système expert</span>
                        </div>
                        <?php }else{?>
                            <div class="col-sm-10">
                            <span class="text-center h5" style="font-family:'Berlin Sans FB';">L'hypothèse <?php echo "<span class=\"text-center h3 text-success\" style=\"font-family:'Berlin Sans FB';\"> $hypothese </span>"?> a été prouvé avec succès !!! voir la démonstration pour <a href="?page=explication" class="text-warning">[+Détails]</a></span>
                        </div>
                        <?php }?>
                   </div>
                </div>


            </div>
        </div>


    </div>
</section>
                
