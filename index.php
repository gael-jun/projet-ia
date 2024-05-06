<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App-Med</title>

    <!-- Custom fonts for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .element {
  position: relative;
}

.element::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5); /* Couleur du voile et sa transparence */
}

    </style>
</head>
<body class="bg-light""> 
    
    <div class="container-fluid text-center p-4 d-flex align-items-center justify-content-center" style="border-top-right-radius: 9px; border-top-left-radius: 9px; font-family: Bauhaus 93; background-color: rgb(5, 141, 159);color: white;">  
        <div class="sidebar-brand-icon ">
            <img src="assets/img/logo-medecine-traditionnelle.png" style="width: 70px; height: 70px;border-radius: 10px;">
        </div>
        <div class=" mx-3" style="font-size: 10px; font-family: 'Blippo';color: black"><h3>MedTrad</h3></div>
    </div>
    <div class="container-fluid text-center justify-content-center element p-5" style=" height: 100vh; width : 100%; background-image: url('assets/img/med1.jpg'); background-size: cover; background-repeat: no-repeat;">
        <div class="row">

            <div class="col-lg-3 mb-4">
                

            </div>

            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-5">
                    <div class="card-header py-3 text-center">
                        <h6 class="m-0 font-weight-bold text-primary">L'EXPERT</h6>
                    </div>
                    <div class="card-body">
                        <div class="p-2 text-center">
                            <img src="assets/img/undraw_profile_2.svg" alt="" style="width: 8rem; height: 8rem;border-radius: 25%; " class="mb-2">
                            <div class="p-4">
                                <form class="user">
                                    <div class="form-group row">  
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for=""><b>Nom d'utilisateur</b></label>
                                            <input type="text" class="form-control form-control-user" id="exampleLastName" value="utilisateur1"
                                                >
                                        </div>
                                        <div class="col-sm-6">
                                            <label for=""><b>Mot de Passe</b></label>
                                            <input type="password" class="form-control form-control-user" id="exampleFirstName" value="utilisateur1"
                                                >
                                        </div>
                                        
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <a href="#" class=" btn btn-secondary btn-user btn-block">
                                                Annuler
                                            </a>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="expert/index.php" class=" btn btn-user btn-block" style="background-color: rgb(5, 141, 159);color: black;">
                                                Soumettre
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <footer class="sticky-footer" style="background-color: rgb(238, 246, 248);">
        <div class="container my-auto">
            <div class="copyright text-center my-auto txt">
                <span><b style="color:black;">Copyright &copy; MedTrad 2024</b></span>
            </div>
        </div>
    </footer>

</body>
</html>