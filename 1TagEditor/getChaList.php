<?php

  require_once "./cls/DBManager.php";

  $dbm = new DBManager();

  // 캐릭터 이름으로 출력
  $result = array();
  $callback = $_GET['callback'];

  // 특정 캐릭터 이름으로 캐릭터 검색
  $sql = "SELECT name FROM cha_info";
  $dbm->useSql($sql,[]);
  $result = $dbm->sttFetchAllAssoc();

  // json 결과값 출력
  echo $callback . "(" . json_encode($result) . ")";
?>
