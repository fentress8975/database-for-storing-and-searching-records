<?php
$route = explode('/', $_SERVER['REQUEST_URI']);
if (!empty($route[1]) && $route[1] === "search") {

    $host     = 'mysql';
    $dbname   = 'test';
    $user     = 'root';
    $password = 'root';
    $port     = 3306;
    $charset  = 'utf8mb4';
    $db;

    $result;

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try {
        $db = new mysqli($host, $user, $password, $dbname, $port);
        $db->set_charset($charset);
        $db->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
    } catch (\Throwable $th) {
        echo "Ошибка подключения к БД: \n";
        echo $th->getMessage();
        die();
    }

    function searchForData(string $param, mysqli $db)
    {
        $sql = "SELECT name,body FROM comments WHERE body LIKE ?";
        $stmt = $db->prepare($sql);
        $param = '%' . $param . '%';
        $stmt->execute([$param]);
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    

    $searchWord = $_GET[array_key_first($_GET)];

    if(strlen($searchWord)<=3 ){
        http_response_code(406);
        echo "Искомое слово меньше 3 символов";
        die();
    }
    $result = searchForData($_GET[array_key_first($_GET)], $db);
    if(!$result){
        http_response_code(418);
        echo "Нету совпадений";
        die();
    }

    header('Content-Type: application/json;');
    echo json_encode($result);
    die();

}

