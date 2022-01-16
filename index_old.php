<?php
// сохранить utf-8 !
// -------------------------------------------------------------------------- логины пароли
$mysql_host = "localhost"; // sql сервер
$mysql_user = "q90932z7_app"; // пользователь
$mysql_password = "fxbZU*85"; // пароль
$mysql_database = "q90932z7_app"; // имя базы данных chat

// -------------------------------------------------------------------------- если база недоступна
if (!mysql_connect($mysql_host, $mysql_user, $mysql_password)) {

    echo "<h2>База недоступна!</h2>";
    exit;
} else {
// -------------------------------------------------------------------------- если база доступна
    echo "<h2>База доступна!</h2>";


    mysql_select_db($mysql_database);
    mysql_set_charset('utf8');
// -------------------------------------------------------------------------- выведем JSON
    $q = mysql_query("SELECT * FROM chapter");
    echo "<h3>Json ответ:</h3>";
// Выводим json
    while ($e = mysql_fetch_assoc($q))
        $output[] = $e;
    print(json_encode($output));

// -------------------------------------------------------------------------- выведем таблицу
    $q = mysql_query("SELECT * FROM chapter");
    $table = iconv('utf-8','windows-1251','Табличный вид:');
    echo "<h3>$table</h3>";

    echo "<table border=\"1\" width=\"100%\" bgcolor=\"#999999\">";
    echo "<tr><td>id</td><td>title</td>";
    echo "<td>description</td></tr>";

    for ($c = 0; $c < mysql_num_rows($q); $c++) {

        $f = mysql_fetch_array($q);
        echo "<tr><td>$f[id]</td><td>$f[title]</td><td>$f[description]</td></tr>";

    }
    echo "</tr></table>";

}
mysql_close();
// -------------------------------------------------------------------------- разорвем соединение с БД
