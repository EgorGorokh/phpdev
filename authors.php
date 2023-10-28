<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHPDevTest</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>
<body>

<?php

require_once 'DataBase.php';
$dataBase=new DataBase();
$connect=$dataBase->getConnection();
$books=$dataBase->getBooks($connect);
$authors=$dataBase->getAuthors($connect);

?>
<div class="container">
    <div style="margin-top:30px;"><a href="index.php" style="color:black; ">Список книг</a></div>
    <div class="authors">
    <?php
foreach ($authors as $arr => $value) {
    ?>

<div class="card" style="width: 18rem;   margin-top:50px">
    <div class="nameAuthor">
        <?php echo $value['name']; ?>
     </div>
    <div class="image">
    <div><img src="imgAuthors/<?php echo($value['photo'].'.jpeg'); ?>"></div>



    <?php
    $i=1;
foreach ($books as $arr => $book) {
    if($book['id_author']==$value['id']) {
        echo $i.")".$book['name']." ";
        $i++;
    }
}
    ?>



    </div>
   
    </div>

  <?php } ?>
  </div>
</div>
</div>








<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>