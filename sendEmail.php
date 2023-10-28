<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Адрес электронной почты, на который нужно отправить сообщение
    $to = 'egoriknightmare@gmail.com';

    // Заголовки письма
    $headers = "From: $name <$email>" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";

    // Тема письма
    $subject = 'Новое сообщение с формы контакта';

    // Тело письма
    $body = "<p><strong>Имя:</strong> $name</p>";
    $body .= "<p><strong>Email:</strong> $email</p>";
    $body .= "<p><strong>Сообщение:</strong> $message</p>";



    $charset = 'utf-8'; // Кодировка письма
    $to = ""; // Получатель
    $subject = ""; // Тема письма
    $text = ""; // Контент письма
    $from = ""; // Отправитель
    $fromName = ""; // Имя отправителя
    // Вот что такое заголовки
    $headers = "MIME-Version: 1.0\n";
    $headers .= "From: =?$charset?B?".base64_encode($fromName)."?= <$from>\n";
    $headers .= "Content-type: text/html; charset=$charset\n";
    $headers .= "Content-Transfer-Encoding: base64\n";

    return  mail("=?$charset?B?".base64_encode($to)."?= <$to>", "=?$charset?B?".base64_encode($subject)."?=", chunk_split(base64_encode($text)), $headers, "-f$from");




    /* Отправка письма
    if (mail($to, $subject, $body, $headers)) {
        echo 'success';
    } else {
        echo 'error';
    }
    */
}
