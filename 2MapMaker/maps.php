<!DOCTYPE html>
<html>
  <head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Tangerine">

    <style>
      .selected {
        border: 3px solid red;
        margin:-3px;
      }


      table {
            border: 2px solid black;
            border-spacing: 0px 0px;
      }
      td {
        border: 1px solid black;
        padding: 0px;
      }

      img {
        width: 40px;
        height: 40px;
      }
      .mImg{
        padding:0px;
      }



      .text {
        font-family: 'Tangerine', serif;
        font-size: 48px;
        position:absolute;
        font-weight:bold;
        color:#BDBDBD;

      }

    </style>
    <script>

    $(function() {
      $('.pImg').on('click',function(e){
        e.preventDefault();
        $('.pImg').removeClass('selected');
        $(this).addClass('selected');
      });

      $('.mImg').on('click',function(e){
        e.preventDefault();
        if($('.selected').hasClass('textBox')){
          var text = prompt('값 입력');
          $(this).append("<div class='text'>"+ text + "</div>");

        } else if($('.selected').hasClass('delBox')){
          $(this).attr('background','');
          $(this).children().remove();

        } else if($('.selected').hasClass('object')){
          var objSrc = $('.selected').attr('src');
          $(this).children().remove();
          $(this).append("<img src="+ objSrc +">");

        } else {
          var imgSrc = $('.selected').attr('src');
          $(this).attr('background',imgSrc);
        }
      })
    });
    </script>
  </head>
  <body>
    <br><br><br><br><br><br><br><br>
    <table id='palete'>
      <?php
        $col = 3;
        $row = 3;

        for($i=0; $i<$col; $i++){
          echo ("<tr>");
          for($j=0; $j<$row; $j++){
            echo("<td id =p".$i."_".$j."><img src=pic".$i."_".$j.".jpg class='pImg'></td>");
          }
          echo ("</tr>");
        }
      ?>
      <tr>
        <td><img class="object pImg" src='man.png'></td>
        <td><img class="object pImg" src='dog.png'></td>
        <td><img class="object pImg" src='bird.png'></td>
      </tr>
      <tr>
        <td class="textBox pImg">TEXT</td>
        <td class="delBox pImg">DEL</td>
        jquery, D3js,
      </tr>
    </table>
    <br>
    <table id='map'>
    <?php
      $col = 10;
      $row = 20;

      for($i=0; $i<$col; $i++){
        echo ("<tr>");
        for($j=0; $j<$row; $j++){
          echo("<td width='40px' height='40px' class='mImg' id=m".$i."_".$j."></td>");
        }
        echo ("</tr>");
      }
    ?>
    </table>

  </body>
</html>
