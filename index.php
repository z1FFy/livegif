<?php
  $file = fopen("number.txt","r");
  
      $buff = fread ($file,100);
      $m = $buff - 5;
      $n = 1;
while ($m <= $buff)
{
$img.= '<img src="'.$m.'/animegif.gif" width="130px">';
if ($n == 3) {
$img.='<br>';
$n= 0;
}
$m++;
$n=$n+1;
}
?>
<html>
<head>
<title>LiveGif Гифуй</title>
 <meta charset="utf-8" />
<style>
body {
background-image:url('bg.jpg');
background-repeat:repeat;
}
#canvas {
visibility:hidden;
height:1px;
}

#snap,#snap2,#submit {
border: solid 1px #209BA0;
width: 100;
height: 40;
background: white;
background: -moz-linear-gradient(top, white 0%, #F1F1F1 50%, #E1E1E1 51%, #F6F6F6 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,white), color-stop(50%,#F1F1F1), color-stop(51%,#E1E1E1), color-stop(100%,#F6F6F6));
background: -webkit-linear-gradient(top, white 0%,#F1F1F1 50%,#E1E1E1 51%,#F6F6F6 100%);
background: -o-linear-gradient(top, white 0%,#F1F1F1 50%,#E1E1E1 51%,#F6F6F6 100%);
background: -ms-linear-gradient(top, white 0%,#F1F1F1 50%,#E1E1E1 51%,#F6F6F6 100%);
background: linear-gradient(to bottom, white 0%,#F1F1F1 50%,#E1E1E1 51%,#F6F6F6 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f6f6f6',GradientType=0 );
}
} 
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>



<script type="text/javascript">
//=====================================// 
//======Главная Функция снимка========//
//===================================// 

$(function(){
	var canvas = $("#canvas")[0],
	context = canvas.getContext("2d"),
	video = $("#video")[0],
	videoObj = { "video": true },
	errBack = function(error) {
		console.log("Ошибка видео захвата: ", error.code); 
	};
	var i=1;
        var a=1;
	// Подключение потока
	if(navigator.getUserMedia) {
		navigator.getUserMedia(videoObj, function(stream) {
			video.src = stream;
			video.play();
		}, errBack);
	} else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
		navigator.webkitGetUserMedia(videoObj, function(stream){
			video.src = window.webkitURL.createObjectURL(stream);
			video.play();
$("#snap,#snap2").removeAttr("disabled");

		}, errBack);
	}
// Обработка событий по щелку кнопками
var node = document.getElementById('snap');

//При удержании+
node.onmousedown = function () {
shake();

}
//Когда отпустили-
document.onmouseup = node.onmouseup = function () {
        clearInterval(window.x);
}




//Функция записи кадров в инпуты для отправки в php
function shake() {
      x = setInterval(function () {
		  context.drawImage(video, 0, 0, 500, 400);
		  $.post('/', { img : canvas.toDataURL('image/jpeg') });
img = document.getElementById("canvas").toDataURL("image/jpeg"),"save";
	//document.getElementById('img').innerHTML = '<img src="'+img+'">';
    hid = document.createElement('input');
    hid.type = 'hidden';
    a=i+a;    
    hid.name = 'perem'+a;
    hid.value = img;
//также в инпуты добавляем кол-во кадров
$("input[name='ckoka']").prop({
  value: a });
    document.getElementById("form").appendChild( hid );
  if (a >= 200) { 
clearInterval(window.x);
};
if (a >= 2) {
$("#submit").removeAttr("disabled");
};
},300);

}

$("#snap2").toggle(
  function () {
    $("#snap2").attr({
          "value": "Stop"
        }); 
  shake();
  },
  function () {
  $("#snap2").attr({
          "value": "Record"
        }); 
     clearInterval(window.x);
  }
);


})// Конец единой функции снимка канваса==========




$('#submit').click(function() {	
 theImages = new Image();
   theImages.src =  img;
	})



	

</script>
</head>
<body>
<img src="logo.png" width="330px" height="200px" style="
    left: 40px;
    position: absolute;
    z-index: 100;
">
<div style="margin-left: 400px;">Разрешите использование вашей камеры</div>
<div style="position: absolute;top: 1px;opacity:0.5"><?php echo $img; ?> </div>

<div style="margin-top: 200px;
position: absolute;">
<br><button disabled id="snap">Click</button>
<input disabled type="button" id="snap2" value="Record">	
	
<form action="Example.php" method="POST" id="form">
<div style="position: absolute;
top: 18px;
left: 230px;
width: 180px;">
<input name="ckoka" value="" style="width:50px;border: 0px;
font-size: 20px;">
<button disabled id="submit"  value="Ok">Save</button>
</div>	
</form>
<div style="position: absolute;
top: -255;
left: 400;">
<canvas id="canvas" width="500" height="400"></canvas>
<video id="video" width="390" height="295" autoplay></video>
<div id="img"><div>
</div>
</div>
</body>
</html>
