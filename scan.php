<?php

// Подключаем автозагрузчик Composer
require 'vendor/autoload.php';

// Подключаем Guzzle HTTP
$client = new \GuzzleHttp\Client();

// Подключаем ParseCsv к нашему файлу
$csv = new \ParseCsv\Csv('urls.csv');

for ($i = 0; $i < count($csv->data); $i++) {
    try {
        // Делаем http-запрос
        $httpResponse = $client->options($csv->data[$i]["FieldName"]);
    
        // Проверяем ответный код
        if ($httpResponse->getStatusCode() >= 400) {
            throw new \Exception();
        }
    } catch (\Exception $e) {
        // Неправильные URL посылаем на вывод
        echo $csv->data[$i]["FieldName"]."</br>";
    }
} 
