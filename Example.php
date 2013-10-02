    <meta charset="utf-8" />
<title>Save your Gif</title>
<style>
#lal {
-webkit-filter: sepia(20%); 
}
</style>
<?php
include('GIFEncoder.class.php');

//////////////////////////////
// LiveGif Module          // 
////////////////////////////
//    Kuschenko Denis    //
//////////////////////////




//Работа с файлом и номером для папки
$fileo = fopen("number.txt","r");
$buff = fread ($fileo,100);
$buff= $buff+1;
fclose($fileo);

 mkdir($buff,0777);
 mkdir($buff.'/'.$buff,0777);

$files=fopen("number.txt", "w+");
fputs ($files, $buff);
fclose($files);
////////////////////



//Запись кадров в папку
$x = 2;
$ckoka = $_POST['ckoka'];
//$ckoka= $ckoka - 1;
//setcookie('ckoka', $ckoka);
while ($x <= $ckoka):
 $per = 'perem'.$x;

 $url = $_POST[$per];

 $url =  substr($url, 23, strlen($url)-0); //вернёт "строка"
 $url = base64_decode($url);

 $image = imagecreatefromstring($url);
        ob_start();
        imagepng($image);
        $filename = $buff.'/'.$buff.'/'.$x.'.jpeg';
        $binaryImage = ob_get_clean();
        $file = fopen ($filename, 'w');
        fwrite($file, $binaryImage);
     $x++;
endwhile;

//////////////////////GET










Error_Reporting(E_ALL & ~E_NOTICE); 


//Функция очистки папки
function recRMDir($path){ 
    if (substr($path, strlen($path)-1, 1) != '/') $path .= '/'; 
    if ($handle = @opendir($path)){ 
        while ($obj = readdir($handle)){ 
            if ($obj != '.' && $obj != '..'){ 
                if (is_dir($path.$obj)){ 
                    if (!recRMDir($path.$obj)) return false; 
                }elseif (is_file($path.$obj)){ 
                    if (!unlink($path.$obj))    return false; 
                    } 
            } 
        } 
          closedir($handle); 
            if (!@rmdir($path)) return false; 
          return true; 
    } 
   return false; 
}  



$i = 2;
$m = $ckoka;
$m = $m+1;
/*
  $file = fopen("number.txt","r");
  
      $buff = fread ($file,100);
     */

while ($i < $m)
{
$image = imagecreatefrompng($buff.'/'.$buff.'/'.$i.'.jpeg');
imagestring($image, 5, 5, 5,'LiveGif',0);
ob_start();
imagegif($image);
$frames[]=ob_get_contents();
$framed[]=1;        
ob_end_clean();
$i++; 
}
$gif = new GIFEncoder($frames,$framed,0,2,0,0,0,'bin');
recRMDir($buff.'/'.$buff);

$fp = fopen($buff.'/'.'animegif.gif', 'w');
fwrite($fp, $gif->GetAnimation());
fclose($fp);

//запрещаем уежам смотреть чужие гифки
$fpp = fopen($buff.'/'.'index.php', 'w');
fwrite($fpp, 'net dostypa, pnx');
fclose($fpp);
echo '<img src="logo.png" width="330px" height="200px"><h1><a href="index.php">reply</a></h1>';
echo '<img id="lal" src="'.$buff.'/animegif.gif"><br>';


?>
