<?php
  class DBmanager{
    var $dbm;
    var $stt;
    function __construct(){
      try {
        $hostname   = 'localhost';
        $dbname     = 'chatag';
        $hosInfo    = 'mysql:host='.$hostname.';dbname='.$dbname.';charset=utf8';
        $username   = 'root';
        $password   = '1234';

        $this->dbm = new PDO($hosInfo,$username,$password);


      } catch (PDOException $e) {
        echo "PDOerror : {$e->getMessage()}";
      }
    }
    // 현재 stt의 fetch::ASSOC한 값을 반환
    function sttFetchAssoc(){
      try {
        return $this->stt->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        echo "PDOerror : {$e->getMessage()}";
      }
    }
    // 현재 stt의 fetchAll의 fetch::ASSOC한 값을 반환
    function sttFetchAllAssoc(){
      try {
        return $this->stt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        echo "PDOerror : {$e->getMessage()}";
      }
    }
    // SQL 사용 후 statement에 적용
    function useSql($sql,$argArr){
      try {
        $this->stt = $this->dbm->prepare($sql,array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
        $result = $this->stt->execute($argArr);
      } catch (PDOException $e) {
        echo "PDOerror : {$e->getMessage()}";
      }
    }

    // 현재 stt의 rowCount값반환
    function rowCount(){
      try {
        return $this->stt->rowCount();
      } catch (PDOException $e) {
        echo "PDOerror : {$e->getMessage()}";
      }

    }
  }


?>
