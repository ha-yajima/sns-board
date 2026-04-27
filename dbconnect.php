<?php
try {
    $db = new PDO('mysql:dbname=mini_bbs;host=localhost;charset=utf8mb4','root','');
}
catch (PDOException $e ) {
    echo 'DB接続エラー： '.$e -> getMessage();
}
?>