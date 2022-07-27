
<?php
	$host='localhost';
	$username='root';
	$password='';
	$dbname = "articles";
	$connection = mysqli_connect($host,$username,$password,"$dbname");
	if(!$connection)
        {
          die('Could not Connect MySql Server:' .mysql_error());
        }
    
//var_dump($_POST);

    ?>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    </head>
 <body>

            <?php
                 $id=$_GET['id'];
                $query = "select * from article where id = $id";
                $result = $connection -> query($query);
                if($result -> num_rows > 0)
                {
                    while($row = $result -> fetch_assoc()){
                        $id = $row['id'];
                
            ?>

<div class="container"style="width:100% ;">
<div class="card" style="width: 50rem; margin-top:50px">
  <img style="width:200px ; height:100px;" src="<?='upload_images/'.$row['photo']?>"class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?=$row['title']?></h5>
    <p class="card-text"><?= $row['body']?></p>
    <a href="articles.php" class="btn btn-primary">Go Back</a>
  </div>
</div>
   
                    </div>



 </body>
</html>
    
<?php
                    }}
                    ?>