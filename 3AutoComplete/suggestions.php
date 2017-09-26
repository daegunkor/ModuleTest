<?php

// require_once "dbmanager.php";
// 	$q = connect();
//
//     if($_POST) {
//         $q=$_POST['searchword'];
//         $result=mysql_query("SELECT * FROM test WHERE title LIKE '$q%' LIMIT 5");
//
//         while($row=mysql_fetch_array($result)) {
//             $title=stripslashes($row[title]);
//             $no=$row[no];
//
//
//             echo "
//                 <div class='display_box' onclick='javascript:goDetail($no);'>
//                     <b>$title</b><br/>$author
//                 </div>
//             ";
//         }
//     }
?>

<?php
	require_once "dbmanager.php"; //db연결을 위한 파일 호출
	$obj = connect(); //db 연결

	if($_POST){
		$q = $_POST['searchword']; //검색한 이름을 q에 담는다.
		// $sql = "insert into test(title) values('$q')";
		$sql = "INSERT INTO test(title) VALUES ('$q') ON DUPLICATE KEY UPDATE title='$q'";
		//검색한 명이 중복되면 업데이트 중복되지 않으면 입력
		$stt = $obj -> prepare($sql);
		$stt->execute();
	}
		if($_POST){
			$q = $_POST['searchword'];
			$sql = "SELECT * FROM test WHERE title LIKE '%$q%' LIMIT 5";
			//검색한 테이블에서 일치하는 단어 검색 5개 까지만
			$stt = $obj -> prepare($sql);

			$stt->execute();

			while($row = $stt -> fetch(PDO::FETCH_ASSOC)){ //5개 까지 출력
				echo "
				<div class='display_box' style='color:red'>
				<b style='font-size:30px'>{$row['title']}</b><br/>
				</div> ";
			}
		}


 ?>
