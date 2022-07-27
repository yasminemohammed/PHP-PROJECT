
<nav class="navbar navbar-expand-lg bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="Allarticles.php" >All articles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="articles.php">My articles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="logout.php">Logout</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
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

$query=$connection->prepare('SELECT * FROM article ');
$query->execute();
$articles=$query->fetchAll();



?>

<center> <?php echo"<h1>MY articles</h1>";?>
<br>
<a href="add_article.php" id="link"style="text-decoration: none"> Add More Articles </a>
<br>
<a href="logout.php">Logout</a>
<br>

   <table border=2 ; font-size=20px; width=90%>
        <thead>
        <tr>
            <th >ID</th>
            <th >image</th>
            <th >Title</th>
            <th >date of creation</th>
            <th>Controls</th>
        </tr>
        </thead><tbody>
<?php

foreach ($articles as $article){?>
<?php

?>

        <tr>
            <th ><?= $article['id']?></th>


            <td><a href="view_article.php?id=<?= $article['id']?>" style="text-decoration: none"><img style="width:200px ; height:100px;" src="<?='upload_images/'.$article['photo']?>"></a>
</td>
            <td><?= $article['title']?></td>
            <td><?= $article['dateCreate']?></td>    

            <td>

            <a href="view_article.php?id=<?= $article['id']?>" style="text-decoration: none">view </a>
            <a href="delete_article.php?id=<?= $article['id']?>" style="text-decoration: none">delete </a>
                
            <a href="edit_article.php?id=<?= $article['id']?>" style="text-decoration: none">edit</a>


            </td>
           
        
        </tr>




<?php
}
?> 
</tbody>

    </table>
   
       
</center>
</html>
<?php
}else{
    echo "you are not logged";
}?>





<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

