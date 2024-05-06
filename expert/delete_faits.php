<?php
    require_once('connect.php');
        $id = $_GET['id_faits'];
        $DelSql = "DELETE FROM `faits` WHERE id_faits='$id' ";

        $res = mysqli_query($con, $DelSql);
        if ($res){
            header("Location:index.php?page=faits");
        }else{
            echo "Echec de suppression";
        }
?>