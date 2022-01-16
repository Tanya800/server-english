<?php
// ---------------------------------------------------------- эти значения задавались при создании БД на сервере

include 'db/db.php';

// ---------------------------------------------------------- проверяем переданные в строке запроса параметры
// например ...server.php?action=select
//-----------------------------------------------------------
// переменная action может быть:
// select - формируем содержимое таблицы chat в JSON и отправляем назад
// insert - встваляем новую строку в таблицу chat, так же нужны 4 параметра : автор/получатель/время создания/сообщение
// ВАЖНО время создания мы не передаем в параметрах, его берем текущее на сервере
// delete - удаляет ВСЕ записи из таблицы chat - пусть будет для быстрой очистки

// ------------------------------------------- получим переданный action
if (isset($_GET["action"])) {
    $action = $_GET['action'];
}
// ------------------------------------------- если action=insert тогда получим еще author|client|text
if (isset($_GET["author"])) {
    $author = $_GET['author'];
}
if (isset($_GET["client"])) {
    $client = $_GET['client'];
}
if (isset($_GET["text"])) {
    $text = $_GET['text'];
}
// ------------------------------------------- если action=select тогда получим еще data - от после какого времени передавать ответ
if (isset($_GET["id"])) {
    $id = $_GET['id'];
}


mysql_connect($mysql_host, $mysql_user, $mysql_password); // коннект к серверу SQL
mysql_select_db($mysql_database); // коннект к БД на сервере
mysql_set_charset('utf8'); // кодировка
// ------------------------------------------------------------ обрабатываем запрос если он был
if($action == select_terms){ // если действие SELECT

    if($id == null){

        $q=mysql_query("SELECT * FROM terms");

    }else{

        $q=mysql_query("SELECT * FROM terms WHERE id = $id");

    }
    while($e=mysql_fetch_assoc($q))
        $output[]=$e;
    print(json_encode($output));

}

if($action == select_professions){ // если действие SELECT

    if($id == null){

        $q=mysql_query("SELECT * FROM professions");

    }else{

        $q=mysql_query("SELECT * FROM professions WHERE id = $id");

    }
    while($e=mysql_fetch_assoc($q))
        $output[]=$e;
    print(json_encode($output));

}

if($action == select_trends){ // если действие SELECT

    if($id == null){

        $q=mysql_query("SELECT * FROM trends");

    }else{

        $q=mysql_query("SELECT * FROM trends WHERE id = $id");

    }
    while($e=mysql_fetch_assoc($q))
        $output[]=$e;
    print(json_encode($output));

}

if($action == select_languages){ // если действие SELECT

    if($id == null){

        $q=mysql_query("SELECT * FROM languages");

    }else{

        $q=mysql_query("SELECT * FROM languages WHERE id = $id");

    }
    while($e=mysql_fetch_assoc($q))
        $output[]=$e;
    print(json_encode($output));

}

//if($action == insert && $author != null && $client != null && $text != null){ // если действие INSERT и есть все что нужно
//
//// время = время сервера а не клиента !
//    $current_time = round(microtime(1) * 1000);
//// пример передачи скрипту данных:
//// chat.php?action=insert&author=author&client=client&text=text
//// вставим строку с переданными параметрами
//    mysql_query("INSERT INTO `chat`(`author`,`client`,`data`,`text`) VALUES ('$author','$client','$current_time','$text')");
//
//}

//
//if($action == delete){ // если действие DELETE
//// полностью обнулим таблицу записей
//    mysql_query("TRUNCATE TABLE `chat`");
//}

mysql_close();
?>