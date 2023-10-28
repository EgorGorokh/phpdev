<?php











require_once 'DataBase.php';
$dataBase=new DataBase();
$conn=$dataBase->getConnection();

if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}


$page = $_POST['page'];
$perPage = $_POST['perPage'];


$start = ($page - 1) * $perPage;
$end = $start + $perPage - 1;


$sql = "SELECT * FROM books LIMIT $start, $perPage";
$result = $conn->query($sql);







if ($result->num_rows > 0) {
   
    echo "<div class='books'>";
    echo "<div style='margin-top:30px'><a href='authors.php'  style='color:black;'>Aвторы</a></div>";



    while ($row = $result->fetch_assoc()) {
        echo "<div class='card'>";
        echo "<div class='namebook'>".$row["name"]."</div>";
        ?>
        <div><img src="imgBooks/<?php echo($row['image'].'.jpeg'); ?>">
        </div>


        
<?php

        echo "<div class='nameauthor'>" . $row["author"] . "</div>";
        echo "<div><button data-card-id='1' id='btnShowForm' class='btn btn-primary' style='width:250px'>Оформить заявку на книгу</button></div>";
        echo "</div>";
       ?>




<?php
    }
    echo "</div>";
}


$sql = "SELECT COUNT(*) AS total FROM books";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalRecords = $row['total'];


$totalPages = ceil($totalRecords / $perPage);
echo "<div class='pagination'>";
if ($page > 1) {
    echo "<li><a href='#' data-page='1'>Первая</a></li>";
    echo "<li><a href='#' data-page='" . ($page - 1) . "'>Предыдущая</a></li>";
}
for ($i = max(1, $page - 5); $i <= min($page + 5, $totalPages); $i++) {
    echo "<li " . ($page == $i ? "class='active'" : "") . "><a href='#' data-page='$i'>$i</a></li>";
}
echo "</div><div class='last'>";
if ($page < $totalPages) {
    echo "<li><a href='#' data-page='" . ($page + 1) . "'>Следующая </a></li>";
    echo "<li><a href='#' data-page='$totalPages'>Последняя</a></li>";
}
echo "</div>";

$conn->close();
?>