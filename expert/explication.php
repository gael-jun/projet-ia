

<section>
    <div class="row d-sm-flex align-items-center justify-content-between ">
        <div class="h1 mb-0 text-gray-800" style="font-family: 'Gabriola';color: black"><b>Explications</b></div>
    </div>

    <div class="card">
        <div class="card-title d-sm-flex align-items-center justify-content-between mb-2">
            <h4 class="h4 mb-0 mt-3 ml-3 text-gray-800" style="font-family: 'Gabriola';color: black"><b>Ici vous avez la preuve de la dernière hypothèse verifiée</b></h1>

        </div>

        <div class="card-body bg-white">
        <?php
        function listeVersChaine($lst) {
            $lst = str_replace(["'(", "(", ")"], "", $lst); // Supprimer les caractères spéciaux

            $elements = explode(" ", $lst);
            $elements = array_map(function($element) {
                return str_replace( "SUP", " > ", str_replace("_", " ", $element)); // Remplacer les underscores par des espaces
            }, $elements);

            return implode(" ET ", $elements);
        }

        $important =  ""; 
        function affichage($solution) {
            $i = 0;
            $regles = explode(") ", $solution);
            $valeur_de_verite = str_replace(")", "", end($regles));
            $regles = array_slice($regles, 0 , -1);
            
            //echo count($regles);
            foreach ($regles as $regle) {
                $regle = str_replace(["'(", ")", "("], "", $regle); // Supprimer les caractères spéciaux
                $elements = explode(" ", $regle);
                $conclusion = str_replace("SUP", " > ", str_replace( "_", " ", $elements[0]));
                $hypotheses = array_slice($elements, 1);

                if ($i == 0) {
                    $important = $conclusion;
                    
                }
                $i = $i +1;


                if (empty($hypotheses)) {
                    echo "<span class=\"text-center h4 my-2\" style=\"font-family:'Berlin Sans FB'; color: #636363;\">Pour prouver <span class = \"h4 \" style=\"color : #0087DA; font-family:'Berlin Sans FB';\">$conclusion</span> on utilise le fait initial : <span class = \"h4 \" style=\" color : #2F9F87; font-family:'Berlin Sans FB';\"> $conclusion </span></span> <br>  ";
                } else {
                    $hypothesesChaine = listeVersChaine(implode(" ", $hypotheses));
                    echo "<span class=\"text-center h4 my-2\" style=\"font-family:'Berlin Sans FB'; color: #636363;\">Pour prouver <span class = \"h4 \" style=\" color: #0087DA; font-family:'Berlin Sans FB';\">$conclusion</span> on utilise la règle : <span class = \"h4 \" style=\"color : #3DC6A8; font-family:'Berlin Sans FB';\">SI $hypothesesChaine ALORS $conclusion</span> </span> <br> ";
                }
            }
            return $important;
        }

        $myfile = fopen("cmdout.txt", "r") or die("Unable to open file!");

        $solution = fread($myfile,filesize("cmdout.txt") - 1);

        fclose($myfile);

        if ($solution == "#f"){
            $valeur_de_verite =  "#f";
            echo "<span class = \" h2 my-2 text-warning \"> L'hypothèse n'a pas été prouvé !!! nous vous invitons à verifier une autre hypothèse ou à ajouter des règles</span>";
        } else {
            $important = affichage($solution);
            $h =1;
        }

        ?>

    </div>

    </div>
    



    <?php if ($important != "") {?>
        <div class="row">
            <div class="row d-sm-flex align-items-center justify-content-between ">
                <div class="h1 mb-0 mt-4 text-gray-800" style="font-family: 'Gabriola';color: black"><b>Traitements</b></div>
            </div>
            <div class="card mb-3 mx-3">
                <div class="card-title ">
                    <span>
                        <div class="h4 mt-3 mb-0 text-gray-800" style="font-family: 'Gabriola';color: black">
                            <b>Les differents traitements possibles pour la maladie <span class="text-success"><?php echo $important; ?></span></b>
                        </div>
                    </span>
                </div>
                <div class="card-body">
                    
                    <?php    
            // Requête SQL
                        require_once('connect.php');
                        

                        $sql = "SELECT r.id_regles AS id_regle, r.libelle_regles AS libelle, f_conclusion.libelle_faits AS conclusion, f_premisse.libelle_faits AS premices_regle_courante
                                FROM regles r
                                JOIN liaison l ON r.id_regles = l.regle
                                JOIN faits f_conclusion ON l.conclusion = f_conclusion.id_faits
                                JOIN faits f_premisse ON l.premisse = f_premisse.id_faits
                                WHERE f_premisse.libelle_faits = '$important'";


                            
                        $res = mysqli_query($con, $sql);

                        while ($row = mysqli_fetch_assoc($res)) {

                            $medicament = $row['conclusion'];

                            echo "<i class='bx bx-check-square bx-tada text-success h2' ></i><span class=\"text-center h4 ml-2 my-2\" style=\"font-family:'Berlin Sans FB';\">$medicament </span><br>";
                            
                        }
                    ?>
                    
                </div>
            </div>
        </div>
    <?php }?>

    
</section>