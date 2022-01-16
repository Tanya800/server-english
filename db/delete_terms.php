<?php

include 'db.php';

$id = $_POST['id'];
$table = $_POST['table'];

if (!mysql_connect($mysql_host, $mysql_user, $mysql_password)) {
    exit;
}
elseif (empty($id)) exit;
else {


    mysql_select_db($mysql_database);
    mysql_set_charset('utf8');

    $q = mysql_query("DELETE FROM `$table` WHERE id = $id");

    print(json_encode(1));
}
mysql_close();

?>