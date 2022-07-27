<?php

session_start();


try{
    $db="mysql:host=localhost;dbname=articles;";
    $user="root";
    $dbpassword="";
    $connection= new PDO($db,$user,$dbpassword);
    
}
catch(PDOException $exception){
    echo $exception->getMessage();
}

$err_array = [];


if(isset($_POST['email'], $_POST['password']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query=$connection->prepare("select * from users where email = ? and password = ? ");
    $query->execute([$email ,$password]);
    $user=$query->fetch(PDO::FETCH_ASSOC);
    var_dump($user);

       if($user){
        
        header("Location:articles.php"); 
        $_SESSION['email']=$email;  
            }
            else{
                $err_array['incorrect_login']= "username or password is incorrect";
            }


}
function Clean($input){

    return  trim(strip_tags(stripslashes($input)));
}


?>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <style>
               
         input[type=text] 
         {
            width: 30%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            font-size: 20px;
            }

            input[type=email] 
         {
            width: 30%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            font-size: 20px;
            }
        input[type=password] {
            width: 30%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            font-size: 20px;

            }
        button{
            background-color:blue; /* Green */
            border: none;
            color:white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;

                }
    </style>
</head>
<div class ="container text-center" style="margin-top: 150px;">
        <h2>Login:</h2>
        <form action="<?= $_SERVER['PHP_SELF']?>" method="POST">

             <input type="email"name="email" />
            <?php echo (isset($err_array['email_errors'])?$err_array['email_errors']:'');?><br>

            <input type="password" name="password">
            <?php echo (isset($err_array['password_errors'])? $err_array['password_errors']:'');?><br>
                        
            <button type="submit" >Login</button><br>
        </form>
          
    <?php echo (isset($err_array['incorrect_login'])? $err_array['incorrect_login']:'');?>
            </div>
</body>
</html>