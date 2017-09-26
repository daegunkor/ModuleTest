
<?php
/*
  챕터 추가
  챕터 순서 변경
  챕터 내용 확인
  챕터 연결
*/
?>
<!DOCTYPE html>
<html>
  <head>


    <meta charset="utf-8">
    <title></title>
    <style>

      .window {
        background: #BDBDBD;
        width:1200px;
        height:800px;
      }
      .header {
        border: 1px solid black;
        height: 100px;
      }
      .Mng{
        border: 1px solid black;
        width:350px;
        height:700px;
        float:left;
      }
      .Mng > .list {
        border: 1px solid blue;
        height: 600px;
        overflow:scroll;
      }

      .chapter {
        border: 1px solid black;
        height: 50px;
        font-size: 40px;
      }
      .Mng > .controller {
        border: 1px solid green;
        height: 100px;
      }
      .cont_btn {
        font-size:70px;
      }
      .viewer{
        border: 1px solid black;
        width:800px;
        height:700px;
        float:left;
        overflow:scroll;
        font-size:40px;
      }
      .viewer_onEditable{
          background-color:white;
      }

      .selected {
        border: 3px solid red;
        margin:-2px;
      }
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $(function() {
      var chapter_info_arr = [];
      $('.list').sortable();

      // 클릭 선택
      $(document).on("click", ".chapter",function() {
        var id = $(this).attr('id');
        $('.chapter').removeClass('selected');
        $(this).addClass('selected');
        $('.viewer').attr('contenteditable','true');
        $('.viewer').attr('background-color','white');
        $('.viewer').text(chapter_info_arr[id][1]);
      });
      // 더블클릭 이름 변경
      $(document).on("dblclick", ".chapter",function() {
        var input_title = prompt();
        var id = $(this).attr('id');
        $(this).text(input_title);
        chapter_info_arr[id][0] = input_title;
      });

      // 글씨 입력 입벤트
      $('.viewer').bind("DOMSubtreeModified",function(){
        var id = $('.selected').attr('id');
        chapter_info_arr[id][1] = $('.viewer').html();
      });
      // 챕터 추가
      function add_chapter(){
        var length = chapter_info_arr.length;
        chapter_info_arr[length] = new Array();
        chapter_info_arr[length][0] = "no_title";
        chapter_info_arr[length][1] = "no_context";
        $('.list').append("<div draggable='true' class='chapter' id="+length+">"+ chapter_info_arr[length][0] +"</div>");
      };

      // 챕터 삭제
      function remove_chapter(){
        var id = $('.selected').attr('id');
        // 아이디 재설정
        for(var i = Number(id) + 1; i < chapter_info_arr.length; i++){
          $('#'+i).attr('id', i - 1);
        }
        // 배열값 삭제
        chapter_info_arr[id].pop();
        // 태그 삭제
        $('.selected').remove();
      };


      //jQuery->Javascript 함수 변환
      goAdd_chapter = add_chapter;
      goRemove_chapter = remove_chapter;
    });

    //jQuery->Javascript 함수 변환
    function add_chapter(){
      goAdd_chapter();
    }
    function remove_chapter(){
      goRemove_chapter();
    }
    </script>
  </head>
  <body>
    <div class="window">
      <div class="header">

      </div>
      <div class="Mng">
        <div class="list">
        </div>
        <div class="controller">
          <input class='cont_btn' type="button" onclick="add_chapter()" value=" + ">
          <input class='cont_btn' type="button" onclick="remove_chapter()" value=" - ">
          <input class='cont_btn' type="button" onclick="" value="all">
        </div>
      </div>
      <div class="viewer">
          asd
      </div>
    </div>
  </body>
</html>
