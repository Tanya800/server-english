<?php
include 'db.php';

if (!mysql_connect($mysql_host, $mysql_user, $mysql_password)) {
    exit;
} else {


    mysql_select_db($mysql_database);
    mysql_set_charset('utf8');

    $q = mysql_query("SELECT * FROM terms");

    while ($e = mysql_fetch_assoc($q))
        $output[] = $e;
    print(json_encode($output));
}
mysql_close();
?>