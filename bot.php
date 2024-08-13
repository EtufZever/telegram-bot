<?php

$token = '7355926196:AAETwb5CCyMzqRngvdyK3XBFuHSu3DyIoBM';
$apiURL = "https://api.telegram.org/bot$token/";

$update = json_decode(file_get_contents('php://input'), true);

$chatId = $update['message']['chat']['id'];
$text = $update['message']['text'];

if ($text == "/start") {
    $message = "Привет! Я библиотечный бот. Введите номер книги от 1 до 999, и я пришлю ссылку на ее чтение.";
    sendMessage($chatId, $message);
} elseif (is_numeric($text) && $text >= 1 && $text <= 999) {
    $link = "https://yourlibrary.com/book_$text"; // замените на настоящие ссылки
    sendMessage($chatId, "Вот ссылка на книгу номер $text: $link");
} else {
    $message = "Пожалуйста, введите номер книги от 1 до 999.";
    sendMessage($chatId, $message);
}

function sendMessage($chatId, $message)
{
    global $apiURL;
    $url = $apiURL . "sendMessage?chat_id=$chatId&text=" . urlencode($message);
    file_get_contents($url);
}
