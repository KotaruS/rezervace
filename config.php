<?php

mb_internal_encoding('UTF-8');


define('DSN', 'mysql:host=localhost;dbname=rezervace;charset=utf8;');

define('USERNAME', 'root');

define('PASSWORD', '');

function connection() {
      $db = new PDO(DSN, USERNAME, PASSWORD);
      return $db;
}
?>
