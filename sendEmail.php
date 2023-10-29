<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $surname = $_POST['surname'];
    $namebook = $_POST['namebook'];
    $nameauthor = $_POST['nameauthor'];

    $to = $email; 

    $subject = 'Новое сообщение с формы';
    $body = "Имя: $name\nEmail: $email\nФамилия:\n$surname\nКнига: $namebook\nИмя автора: $nameauthor\n".date('Y-m-d H:i:s');

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";





    $log = date('Y-m-d H:i:s') . $email.$name.$surname.$nameauthor.$namebook.' Запись в лог';
file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);



    if (mail($to, $subject, $body, $headers)) {
        echo 'success';
    } else {
        echo 'error';
    }
    
}