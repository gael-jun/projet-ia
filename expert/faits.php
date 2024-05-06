<?php
    require_once('connect.php');
        if(isset($_POST['envoyer'])){
            
            $lib = $_POST['libelle'] ; $libe=addslashes($lib);

        if(isset($lib) && $lib != "" ){
                       //si ça n'existe pas , créons le compte
                    $resultat ="INSERT INTO faits (libelle_faits) VALUES ('$libe')";

                    $req = mysqli_query($con ,$resultat );
                    if($req){
                           // si le compte a été créer , créons une variable pour afficher un message dans la page de
                           //connexion
                        $_SESSION['message'] = "Le fait a été crée avec succès !" ;
                           //redirection vers la page de connexion
                        echo "<script> window.location.href='index.php?page=faits';</script>";
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
        <h1 class="h1 mb-0 text-gray-800" style="font-family: 'Gabriola';color: black"><b>Enregistrement des faits</b></h1>
    </div>
    <div class="mr-0 d-sm-flex align-items-center justify-content-between mb-0">
            <h4 class="h4 mb-0 my-0  text-gray-800" style="font-family: 'Gabriola';color: black">
            <b>Un fait peut etre une maladie (Ex: Paludisme), un symptome (Ex: Maux de tete) ou un medicament (Ex: ecorce de manguier)
        </b></h4>

    </div>

    <div class="card o-hidden border-0 shadow-lg my-4 txte" style="color: black; text-decoration: solid;" >
        <div class="container-fluid text-center p-2" style="border-top-right-radius: 10px; border-top-left-radius: 10px; font-family: Bauhaus 93; background-color: rgb(5, 141, 159);color: white;">
            <span><b>Gestion des faits</b></span>
        </div>

        <div class="card-body p-0">
            <div class="row p-2">
                <div class="col-xl-5 col-lg-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 text-center">
                            <h6 class="m-0 font-weight-bold text-primary">Creation des faits</h6>
                        </div>
                        <div class="card-body">
                            <div class="p-2 text-center">
                                <div class="p-4">
                                    <?php if(isset($error)): ?>
                                        <div class="pb-2">
                                            <strong class='me-auto text-danger text-center' style="font-family:'Patua One';"><?php echo $error ;?></strong>
                                        </div>
                                    <?php endif; ?>

                                    <form class="user pb-5 pt-5" method="POST" enctype="multipart/form-data">
                                        <div class="form-group row pt-3">  
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user text-center" value="Libelle du fait :" readonly style="font-size:18px;color:black;">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="libelle" class="form-control form-control-user" style="font-size:18px;color:black;">
                                            </div>
                                        </div>

                                        <div class="form-group row mt- 3 pb-3">
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

                <div class="col-xl-7 col-lg-8">
                    <?php
                        require_once('connect.php');
                        $ReadSql = "SELECT *FROM `faits` ";
                        $res = mysqli_query($con, $ReadSql);
                    ?>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 text-center">
                            <h6 class="m-0 font-weight-bold text-primary">Base des faits</h6>
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
                                        <?php $compt = 0;?>
                                            <?php while($r=mysqli_fetch_assoc($res)){  $compt = $compt + 1;?>
                                                <tr>
                                                    <td><?php echo $compt; ?></td>
                                                    <td><?php echo $r['libelle_faits']; ?></td>
                                                    <td>
                                                        <div class="text-center d-flex justify-content-center">
                                                            <a href="?page=edit_faits&id_faits=<?php echo $r['id_faits']; ?>" title="editer">
                                                                <i class="bx bx-edit bx-md" ></i>
                                                            </a>
                                                            <a href="delete_faits.php?id_faits=<?=$r['id_faits'];?>" title="supprimer">
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