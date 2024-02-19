<?php
require_once '../PHP/dbh.php';
if(!empty($_POST['idPro']) and !empty($_POST['userId'])){
        $userId=$_POST['userId'];
        $idPro=$_POST['idPro'];
        $sql1="SELECT * from cart where product_id=$idPro and user_id=$userId";
        $result1=mysqli_query($conn,$sql1) or die(mysqli_error($conn));
        if(mysqli_num_rows($result1)>0){
            echo 0;
        }else{
            $sql2="INSERT INTO cart(product_id,user_id) values($idPro,$userId)";
            $result2=mysqli_query($conn,$sql2) or die(mysqli_error($conn));
            if($result2>0){
                echo 1;
            }else{
                echo 2;
            }
        }
    }

?>