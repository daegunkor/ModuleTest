
var sel;
// 마지막 선택한 텍스트를 전역 변수에 전달.
function setLastSelection(){
  if(window.getSelection){
    var curSel = window.getSelection();
    if(curSel.toString().length > 0)
      sel = curSel;
  }
}

function surroundSelection(chaName, color) {
    var span = document.createElement("span");
    span.style.fontWeight = "bold";
    span.style.color = color;

    span.setAttribute("onmouseover","popChaInfo(\'" + chaName+ "\')");
    span.setAttribute("onmouseout","removeChaInfo()");
    span.setAttribute("class","chaTag");
    span.setAttribute("id",chaName);
        if (sel.rangeCount) {
            var range = sel.getRangeAt(0).cloneRange();
            range.surroundContents(span);
            sel.removeAllRanges();
            sel.addRange(range);
        }

}

function setChaInfo(chaName){
  goSetChaInfo(chaName);
}
function popChaInfo(chaName){
  goPopChaInfo(chaName);
}
function removeChaInfo(){
  goRemoveChaInfo();
}

$(document).ready(function(){

  // 리스트 생성
  function setList(){
    $.ajax({
      url: 'https://localhost/chaInfo/getChaList.php',
      data:{},
      dataType: 'jsonp',
      success: function(data){
        var listData = "";
        for(var i in data){
          listData += "<span onClick=setChaInfo(\'" + data[i].name + "\')>" + data[i].name + "</span><br>"
        }
        $('.chaListDiv').html(listData);
      },
      error: function(){
        $('.chaListDiv').html("오류 발생");
      }
    })
  }

  // 클릭시 메뉴 삭제
  function removeMenu(){
    $("div.custom-menu").hide();
  }
  function removeChaInfo(){
    $(".popChaInfo-menu").hide();
  }

  // 컨텐츠 박스 클릭 시 오른쪽 마우스 생성
  $("div.contentBox").bind("contextmenu", function(event) {
    event.preventDefault();
    $("div.custom-menu").hide();
    var curSel = window.getSelection();
    // 한글자 이상 선택하였을 경우
    if(curSel.toString().length > 0){
      sel = curSel;
      $("<div class='custom-menu'><button class='setTagBtn'>태그적용</button></div>")
          .appendTo("body")
          .css({top: event.pageY + "px", left: event.pageX + "px"});
    }
  }).bind("click", removeMenu);


  // 샘플 호출
  $(".getSampleBtn").click(function(){
    $.ajax({
      url: 'https://localhost/chaInfo/getChaInfo.php',
      data:{
        chaName: "simson"
      },
      dataType: 'jsonp',
      success: function(data){
        $('.chaNameTd').text( "이름 : " + data.name );
        $('.chaTagColorTd').css("background-color", data.tagColor);
        $('.chaTagTd').text( "태그 : " + data.tag );
        $('.chaIntroTd').text( "설명 : " + data.intro );
        $('.chaImg').attr("src", "./img/" + data.imgRoot);
      },
      error: function(){
        $('.chaNameTd').text("오류 발생");
      }
    })
  });

  //캐릭터 정보 리턴
  function getChaInfo(chaName){
    return $.ajax({
      url: 'https://localhost/chaInfo/getChaInfo.php',
      data:{
        chaName: chaName
      },
      dataType: 'jsonp',
    })
  }
  // 캐릭터 정보 적용
  function setChaInfo(chaName){
    $.ajax({
      url: 'https://localhost/chaInfo/getChaInfo.php',
      data:{
        chaName: chaName
      },
      dataType: 'jsonp',
      success: function(data){
        $('.chaNameTd').text( "이름 : " + data.name );
        $('.chaTagColorTd').css("background-color", data.tagColor);
        $('.chaTagTd').text( "태그 : " + data.tag );
        $('.chaIntroTd').text( "설명 : " + data.intro );
        $('.chaImg').attr("src", "./img/" + data.imgRoot);
      },
      error: function(){
        $('.chaNameTd').text("오류 발생");
      }
    })
  }

  function popChaInfo(chaName){
    var x = event.pageX;
    var y = event.pageY;
    getChaInfo(chaName).success(function(data){
      popChaImg(data.imgRoot,x,y);
    });

  }
  function popChaImg(chaImgRoot,x,y){
    $("<div class='popChaInfo-menu'><img src=\'./img/"+ chaImgRoot +"\'></div>")
        .appendTo("body")
        .css({top: y + "px", left: x + "px"});

  }

  // 태그 적용
  $(document).on('click',".setTagBtn", function(){
    var chaName = $(".chaNameTd").text().replace("이름 : ", "");
    getChaInfo(chaName).success(function(data){
      surroundSelection(data.name,data.tagColor);
    });
  });

  $(document).on('click',"#chaListSpan", function(){
    alert($(this).text());
      $.ajax({
        url: 'https://localhost/chaInfo/getChaInfo.php',
        data:{
          chaName: $(this).text()
        },
        dataType: 'jsonp',
        success: function(data){
          $('.chaNameTd').text( "이름 : " + data.name );
          $('.chaTagColorTd').css("background-color", data.tagColor);
          $('.chaTagTd').text( "태그 : " + data.tag );
          $('.chaIntroTd').text( "설명 : " + data.intro );
          $('.chaImg').attr("src", "./img/" + data.imgRoot);
        },
        error: function(){
          $('.chaNameTd').text("오류 발생");
        }
      })
  });

  setList();
  goRemoveChaInfo = removeChaInfo;
  goPopChaInfo = popChaInfo;
  goSetChaInfo = setChaInfo;
});
