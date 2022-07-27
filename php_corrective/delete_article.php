<?php
session_start();
if(isset($_SESSION['email'])){
if(isset($_GET['id'])){
    $id=$_GET['id'];
    try{
        $db="mysql:dbname=articles;host=localhost";
        $user="root";
        $dbpassword="";
        $connection= new PDO($db,$user,$dbpassword);
        
    }
    catch(PDOException $exception){
        echo $exception->getMessage();
    }
    $query=$connection->prepare('DELETE FROM article WHERE id=?');
    $query->execute([$id]);
    header('Location: articles.php');
}}else{
    echo "you are not logged";
}?>