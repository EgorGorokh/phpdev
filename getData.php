<?php
phpinfo();

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



?>

<script>
        $(document).ready(function() {
            $('.btnShowForm').click(function() {
                var cardId = $(this).data('card-id');
                const cx= cardId;
                $('#contactForm_' + cardId).show();

            $('.contactForm').submit(function(e) {
                e.preventDefault();



                var cardId = cx;
                var name = $('#name_' + cardId).val();
                var email = $('#email_' + cardId).val();
                var surname = $('#surname_' + cardId).val();
                var namebook = $('#namebook_' + cardId).val();///
                var nameauthor = $('#nameauthor_' + cardId).val();////




                $.ajax({
                    url: 'sendEmail.php',
                    type: 'POST',
                    data: {name: name, email: email, surname: surname,namebook: namebook,nameauthor: nameauthor},
                  //data: {name: name, email: email, message: message},
                    success: function(response) {
                        $('#contactForm_' + cardId).hide();
                        $('#successMessage_' + cardId).show();
                        
                    }
                });    });
            });
        });
    </script>
    <style>
        .contactForm {
            display: none;
        }

        .successMessage {
            display: none;
            color: green;
            margin-top: 10px;
        }
    </style>

<?php



if ($result->num_rows > 0) {

    echo "<div class='books'>";
    echo "<div style='margin-top:30px'><a href='authors.php'  style='color:black;'>Aвторы</a></div>";


   


    $t=1;
    while ($row = $result->fetch_assoc()) {
       
        echo "<div class='card'>";
        echo "<div class='namebook'>".$row["name"]."</div>";
        ?>
        <div><img src="imgBooks/<?php echo($row['image'].'.jpeg'); ?>">
        </div>


        
<?php

        echo "<div class='nameauthor'>" . $row["author"] . "</div>";
        ?>


       


        <div><button name='<?php echo $t ?>' data-card-id='<?php echo $t ?>' id="btnShowForm" class="btnShowForm" style="width:250px">Оформить заявку на книгу</button></div>
<?php
        echo "</div>";
        ?>
        
        <div id="contactForm_<?php echo $t;
        ?>" class="contactForm">
            <h3>Форма для отправки данных:</h3>
            <form method="post">
                
            <input type="hidden" id='namebook_<?php echo $t?>' value='<?php echo $row['name']?>' required>
            <input type="hidden" id='nameauthor_<?php echo $t?>' value='<?php echo $row['author']?>' required>

                <label for="name">Имя:</label>
                <input type="text" name="name" id='name_<?php echo $t?>' required><br>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email_<?php echo $t?>" required><br>

                <label for="surname">Фамилия:</label>
                <input name="surname" id="surname_<?php echo $t?>" required></input><br>

                <input type="submit" value="Отправить">
            </form>
        </div>

        <div id="successMessage_<?php echo $t; $t++;?>" class="successMessage">
            <p>Данные успешно отправлены!</p>
        </div>
     
        
        
        
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