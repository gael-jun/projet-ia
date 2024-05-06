<?php
    require_once('connect.php');
        if(isset($_POST['envoyer'])){
            
            $lib = $_POST['libelle'] ; $libe=addslashes($lib);
 
           if(isset($lib) && $lib != "" ){
                       //si ça n'existe pas , créons le compte
                       $resultat ="INSERT INTO regles (libelle_regles) VALUES ('$libe')";

                       $req = mysqli_query($con ,$resultat );
                       if($req){
                           // si le compte a été créer , créons une variable pour afficher un message dans la page de
                           //connexion
                           $_SESSION['message'] = "La règle a été crée avec succès !" ;
                           //redirection vers la page de connexion
                           echo "<script> window.location.href='index.php?page=regles';</script>";
                       } else {
                           //si non
                           $error = "Echec de creation !";
                       }
               
            }
            else {
               $error = "Veuillez remplir tous les champs !" ;
           }
        }
?>

<section>
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h1 mb-0 text-gray-800" style="font-family: 'Gabriola';color: black"><b>Enregistrement des regles</b></h1>
    </div>

    <div class="card o-hidden border-0 shadow-lg my-4 txte" style="color: black; text-decoration: solid;" >
        <div class="container-fluid text-center p-2" style="border-top-right-radius: 10px; border-top-left-radius: 10px; font-family: Bauhaus 93; background-color: rgb(5, 141, 159);color: white;">
            <span><b>Gestion des regles</b></span>
        </div>

        <div class="card-body p-0">
            <div class="row p-2">
                <?php if(isset($error)): ?>
                    <div class="pb-2">
                        <strong class='me-auto text-danger text-center' style="font-family:'Patua One';"><?php echo $error ;?></strong>
                    </div>
                <?php endif; ?>
                <div class="col-xl-6 col-lg-7">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 text-center">
                            <h6 class="m-0 font-weight-bold text-primary">Création des regles</h6>
                        </div>
                        <div class="card-body">
                            <div class="p-2 text-center">
                                <div class="p-4">
                                    <form class="user" method="POST" enctype="multipart/form-data">

                                        <div class="form-group row ">  
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user text-center" value="Libelle de la regle :" readonly style="font-size:18px;color:black;">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="libelle" class="form-control form-control-user" style="font-size:18px;color:black;">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="reset" value="Annuler" class=" btn btn-secondary btn-user btn-block">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="submit" class=" btn btn-user btn-block" name="envoyer" value="Sauver" style="background-color: rgb(5, 141, 159);color: black;">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-7">
                    <?php
                        require_once('connect.php');
                        $ReadSql = "SELECT *FROM `regles` ";
                        $res = mysqli_query($con, $ReadSql);
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
                                            <col width="10%">
                                            <col width="50%">
                                            <col width="40%">
                                        </colgroup>
                                        <thead style="font-family: 'Patua One';" >
                                            <tr>
                                                <th>#</th>
                                                <th>Libelle</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php while($r=mysqli_fetch_assoc($res)){ ?>
                                                <tr>
                                                    <td><?php echo $r['id_regles']; ?></td>
                                                    <td><?php echo $r['libelle_regles']; ?></td>
                                                    <td>
                                                        <div class="text-center d-flex justify-content-center">
                                                            <a href="?page=edit_regles&id_regles=<?php echo $r['id_regles']; ?>" title="editer">
                                                                <i class="bx bx-edit bx-md" ></i>
                                                            </a>
                                                            <a href="delete_regles.php?id_regles=<?=$r['id_regles'];?>" title="supprimer">
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