<?php
require_once "php/search.php";
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/simple.css">
    <script src="/js/search.js" type="text/javascript" defer></script>
    <title>Тестовое задание</title>
</head>

<body>

    <main>
        <div>
            <input type="text" name="search" id="search" minlength="3" value="laudanti" required>
            <button onclick="search()">Найти</button>
        </div>

        <div id="result">

        </div>
    </main>

</body>

</html>