<?php
    require_once('connect.php');
        $id = $_GET['id'];
        $DelSql = "DELETE FROM liaison WHERE regle='$id'";

        $res = mysqli_query($con, $DelSql);
        if ($res){
            header("Location:index.php?page=rules");
        }else{
            echo "Echec de suppression";
        }
?>