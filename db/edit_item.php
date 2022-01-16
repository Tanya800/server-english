<?php
include 'db.php';

$id = $_POST['edit_id'];
$table = $_POST['table'];
$title = $_POST['title'];
$description = $_POST['description'];
$query = '';
$name = $table.'_img_'. str_replace(" ", "_", $title);

if(isset($_POST['file_exist'])){

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
    $query = "UPDATE `$table` SET `title`='$title',`description`='$description',`img`='$picture' WHERE `id` = $id ";
}

if (!mysql_connect($mysql_host, $mysql_user, $mysql_password)) {
    exit;
} else {


    mysql_select_db($mysql_database);
    mysql_set_charset('utf8');
    $q = ($query!='')? mysql_query($query) : mysql_query("UPDATE `$table` SET `title`='$title',`description`='$description' WHERE `id` = $id ;");

print($q);
}
mysql_close();
?>