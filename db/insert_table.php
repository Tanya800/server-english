<?php
include  'db.php';

$table = $_POST['table'];
$title = $_POST['title'];
$description = $_POST['description'];

$name = $table.'_img_'. str_replace(" ", "_", $title);

if ( 0 < $_FILES['file']['error'] ) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
}
else {
    $picture =explode(".", $_FILES['file']['name']);
    $picture = end($picture);
    $picture = $name.'.'.$picture;
    move_uploaded_file($_FILES['file']['tmp_name'], '/home/q/q90932z7/q90932z7.beget.tech/public_html/img/'.$picture);
    $picture = 'http://q90932z7.beget.tech/img/'.$picture;
}


if (!mysql_connect($mysql_host, $mysql_user, $mysql_password)) {
    exit;
} else {


    mysql_select_db($mysql_database);
    mysql_set_charset('utf8');

    $q = mysql_query("INSERT INTO `$table` ( `title`, `description`, `img`) VALUES ('$title','$description','$picture')");

    print($q);
}
mysql_close();
?>