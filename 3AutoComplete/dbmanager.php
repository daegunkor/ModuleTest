<?php
  function connect() {
    $dsn = 'mysql:dbname=ex_db; host=localhost';
    $usr = 'root';
    $passwd = '1234';

    try {
      $db = new PDO($dsn, $usr, $passwd);
    } catch (PDOException $e){
      exit("접속불가: {$e->getMessage()}");
    }
    return $db;
  }

 ?>
