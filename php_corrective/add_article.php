
<html>
<head>
<style>
        label{
            font-size: 30px;
        }
         input[type=text] 
         {
            width: 30%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            font-size: 20px;
            }
            input[type=file] 
         {
            width: 30%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            font-size: 20px;
            }
            input[type=date] 
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
            margin-top:20px;

                }
    </style>

</head>
<body>

<form action="<?=$_SERVER['PHP_SELF']?>"  method="post" enctype="multipart/form-data" >
<input type="hidden" name="id" value="<?$_GET['id']?>">

    <label>Title</label>
    <br>
    <input type="text" name="title" >  
    <br>

    <label>description</label>  
    <br>
    <input type="text" name="description">
    <br>

    <label for="image">Choose a picture:</label>
    <br>
    <input type="file"
       id="image" name="image">

    <br>

    <label>date of creation</label>
    <br>
    <input type="date" name="dateCreate" >
    <br>

    <label>body</label>
    <br>
    <input type="text" name="body"> 
    <br>
  


    <button type="submit">Add</button>


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
    
    @$image=$_FILES['image']['name'];
    $string_array=explode('.',$image);
    $extension=end($string_array);
    $allowEx=["jpg","jpeg","png","gif"];
    @$tmp=$_FILES['image']['tmp_name'];
    @$fileSize=$_FILES['image']['size'];
    if(in_array($extension,$allowEx)&&$fileSize<=30855765){
        move_uploaded_file($tmp,'upload_images/'.$image);}
   
  

}
catch(PDOException $exception){
    echo $exception->getMessage();
}
    @$id = $_GET['id'];
    @$title=$_POST['title'];
    @$description=$_POST['description'];
    @$image=$_FILES['image']['name'];
    @$dateCreate=$_POST['dateCreate'];
    @$body=$_POST['body'];
    


    $query = $connection->prepare('INSERT INTO article( title , description , photo , dateCreate , body) VALUES(?,?,?,?,?)');
    $query->execute([$title,$description,$image,$dateCreate,$body]);
    header("Location: articles.php");



