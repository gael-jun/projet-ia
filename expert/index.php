<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>App-MedTradi</title>

        <link href="../assets/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

       
    </head>
    <style>
        .txt{
            color: white;
            font-family: 'Berlin Sans FB';
            font-size: 15px;
        }
        .txte{
            color: rgb(5, 5, 5);
            font-family: 'Rockwell';
        }
        :root {
        --sidebar: rgb(3, 74, 76);
        }
        body{
            color:black;
        }
    </style>

    <body id="page-top">
        <div id="wrapper">
            <?php $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';  ?>
            
            <div>
            <?php require_once('code/navbar.php') ?>
            </div>

            <?php require_once('code/sidebar.php') ?>

            <?php if($page == 'dashboard') {?>

                <div id="content-wrapper" class="mt-5 d-flex flex-column" style="height: 100vh; width : 100%; background-image: url('../assets/img/dashboard.png'); background-size: cover; background-repeat: no-repeat;">
                    <div id="content" class="">
                        <div class="container-fluid mt-0 pt-5">
                            <?php 
                                if(!file_exists($page.".php") && !is_dir($page)){
                                    include '404.html';
                                }else{
                                if(is_dir($page))
                                    include $page.'index.php';
                                else
                                    include $page.'.php';
                                }
                            ?>
                            
                        </div>
                    </div>
                    <footer class="sticky-footer " style="background-color: rgb(238, 246, 248);">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span><b style="color:black; font-family: 'Comic Sans MS';">Copyright &copy; 2024 App-MedTrad SysExpert </b></span>
                        </div>
                    </div>
                </footer>
                </div>
                

                
            <?php } else {?>

        

            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content" class="p-3">
                    <div class="container-fluid mt-3 pt-5">
                        <?php 
                            if(!file_exists($page.".php") && !is_dir($page)){
                                include '404.html';
                            }else{
                            if(is_dir($page))
                                include $page.'index.php';
                            else
                                include $page.'.php';
                            }
                        ?>
                    </div>
                </div>

                <?php include 'code/footer.php'; ?> 
            </div>
            <?php }?>
           
        </div>

        <!--Logout et modal-->
        <div>
            <a class="scroll-to-top rounded bg-success" href="#page-top1">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Prêt à partir?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Sélectionnez « Se déconnecter » ci-dessous si vous êtes prêt à mettre fin à votre session en cours.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                            <a class="btn btn-primary" href="../index.php">Se déconnecter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- les styles js-->
        <div>
            <!-- Bootstrap core JavaScript-->
            <script src="../assets/js/jquery.min.js"></script>
            <script src="../assets/js/bootstrap.bundle.min.js"></script>
            <script src="../assets/js/jquery.easing.min.js"></script>
            <script src="../assets/js/sb-admin-2.min.js"></script>

            <script src="../assets/js/jquery.dataTables.min.js"></script>
            <script src="../assets/js/dataTables.bootstrap4.min.js"></script>

            <script src="../assets/js/datatables-demo.js"></script>

            <script>

                const svgPath = document.querySelectorAll('.path');

                const svgText = anime({
                targets: svgPath,
                loop: true,
                direction: 'alternate',
                strokeDashoffset: [anime.setDashoffset, 0],
                easing: 'easeInOutSine',
                duration: 700,
                delay: (el, i) => { return i * 500 }
                });
            </script>

        </div>
    </body>
</html>
