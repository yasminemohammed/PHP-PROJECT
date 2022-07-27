<?php
session_start();
if(isset($_SESSION['email'])){
try{
    $db="mysql:dbname=articles;host=localhost";
    $user="root";
    $dbpassword="";
    $connection= new PDO($db,$user,$dbpassword);
    
}
catch(PDOException $exception){
    echo $exception->getMessage();
}
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $oldString=$connection->prepare('SELECT * FROM article WHERE id=?');
    $oldString->execute([$id]);
    $article=$oldString->fetch(PDO::FETCH_ASSOC);
    ?>
    <html>
<head>

</head>
<body>

<form action="<?=$_SERVER['PHP_SELF']?>"  method="post" enctype="multipart/form-data" >
    <input type="hidden" name="id" value="<?=$article['id']?>">
    <label for="title">title</label>
    <input type="text" id="title" name="title" value="<?=$article['title']?>">
    <br>
    <br>
    <label for="description">description</label>
    <input type="text" id="description" name="description" value="<?=$article['description']?>">
    <br><br>
    <input type="file" name="image"><span><?=$article['photo']?></span><br>
    <label for="dateCreate">dateCreate:</label>
    <input type="date" id="dateCreate" name="dateCreate" value="<?=$article['dateCreate']?>">
    <br><br>
    <label for="body">body:</label>
    <input type="body" id="body" name="body" value="<?=$article['body']?>"><br><br>

  
     <button type="submit">edit</button>
 
</form>
<?php
}
?>
</body>
</html>


<?php
if(isset($_POST['title'])){
    $id=$_POST['id'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $image=$_FILES['image']['tmp_name'];
    $dateCreate=$_POST['dateCreate'];
    $body=$_POST['body'];

    move_uploaded_file($tmp,'upload_images/'.$image);
    $queryString=$connection->prepare('UPDATE article SET title=?,description=?,photo=?,dateCreate=?,body=? WHERE id=?');
    $queryString->execute([$title,$description,$image,$dateCreate,$body,$id]);

    header("Location:articles.php");
}}else{
    echo "you are not logged";
}?>