<html>
<head>
<style>
               
         input[type=text] 
         {
            width: 50%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            font-size: 20px;
            }
            input[type=date] 
         {
            width: 50%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            font-size: 20px;
            }
        input[type=password] {
            width: 50%;
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
            margin-top:20px;

                }
    </style>

</head>
<body>
<div class =" text-center" style="margin-left:300px">
<h2>Registeration:</h2>


<form action="<?=$_SERVER['PHP_SELF']?>"  method="post" enctype="multipart/form-data" >


    <input type="text" name="f_name" placeholder="Enter your First Name , please">
    <?php echo (isset($err_array['fname_errors'])?$err_array['fname_errors']:'');?>
    <br>


    <input type="text" name="l_name" placeholder="Enter you Last Name , please">
    <?php echo (isset($err_array['lname_errors'])?$err_array['lname_errors']:'');?>
    <br>

    <input type="text" name="email" placeholder="Enter you Email , please">
    <?php echo (isset($err_array['email_errors'])?$err_array['email_errors']:'');?>
    <br>


    <input type="text" name="address" placeholder="Enter you Address , please"> 
    <?php echo (isset($err_array['address_errors'])?$err_array['address_errors']:'');?>
    <br>


    <input type="date" name="dateBirth" placeholder="Enter you Birth date , please">
    <?php echo (isset($err_array['Bdate_errors'])?$err_array['Bdate_errors']:'');?>
    <br>


    <input type="password" name="password" placeholder="Enter you Password , please">
    <?php echo (isset($err_array['password_errors'])? $err_array['password_errors']:'');?>
    <br>


  


    <button type="submit">register</button>

            </div>
</form>
</body>
</html>
<?php
session_start();

//database connection



try{
    $db="mysql:dbname=articles;host=localhost";
    $user="root";
    $dbpassword="";
    $connection= new PDO($db,$user,$dbpassword);
}
catch(PDOException $exception){
    echo $exception->getMessage();
}


if(isset($_POST['email'])){
    $fname=$_POST['f_name'];
    $lname=$_POST['l_name'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $dateBirth=$_POST['dateBirth'];
    $password=$_POST['password'];


    $query = $connection->prepare('INSERT INTO users( f_name , l_name , email , address , dateBirth , password)VALUES(?,?,?,?,?,?)');
    $query->execute([$fname,$lname,$email,$address,$dateBirth,$password]);
    header("Location: login.php");
    var_dump($err_array);

      
   
}
