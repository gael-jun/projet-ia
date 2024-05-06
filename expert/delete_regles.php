<?php
    require_once('connect.php');
        $id = $_GET['id_regles'];
        $DelSql = "DELETE FROM `regles` WHERE id_regles='$id' ";

        $res = mysqli_query($con, $DelSql);
        if ($res){
            header("Location:index.php?page=regles");
        }else{
            echo "Echec de suppression";
        }
?>