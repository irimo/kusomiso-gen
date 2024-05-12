<?php
// $image:���H�O�摜
// $dest:���H��摜

//echo $_FILES['userfile']['type'];
if(isset($_FILES['userfile'])){
	if($_FILES['userfile']['type'] == "image/pjpeg" ||
	 $_FILES['userfile']['type'] == "image/jpeg"){
		$image = imagecreatefromjpeg($_FILES['userfile']['tmp_name']);
		$dest = imagecreatefromjpeg($_FILES['userfile']['tmp_name']);
	}else if($_FILES['userfile']['type'] == "image/png" ||
	  $_FILES['userfile']['type'] == "image/x-png"){
		$image = imagecreatefrompng($_FILES['userfile']['tmp_name']);
		$dest = imagecreatefrompng($_FILES['userfile']['tmp_name']);
	}else if($_FILES['userfile']['type'] == "image/gif"){
		$image = imagecreatefromgif($_FILES['userfile']['tmp_name']);
		$dest = imagecreatefromgif($_FILES['userfile']['tmp_name']);
	}else{
		$image = imagecreatetruecolor(100,100);
		$dest = imagecreatetruecolor(100,100);
	}
}
// imagecolorallocate()�̃o�O����̂��߂ɍ������摜
$work = imagecreatetruecolor(1,1);
		

		
$tex = "A";
$maxsize = 30;
$minsize = 5;

list($w , $h) = getimagesize($_FILES['userfile']['tmp_name']);
if($w > 1280 || $h > 1024) die("�摜�T�C�Y���傫�����܂��B�B�摜���k�߂Ă�蒼���Ă��������B�B");
$loop = ($w * $h) / $maxsize;

$sz = array();
for($i=0;$i<$loop;$i++){
	$sz[] = rand($minsize,$maxsize);
}
foreach($sz as $size)
{
	$x = rand(0 , $w);
	$y = rand(0 , $h);
	$p = imagecolorat($image , $x , $y);
	$color = imagecolorallocate($work , ($p >> 16) & 0xff , ($p >> 8) & 0xff , $p & 0xff);
	if($color){
		ImageTTFText($dest, $size."px", 0, $x, $y, $color, "../abe/abea.ttf",$tex);
	}
	if($tex === "B"){
		$tex = "A";
	} else {
		$tex = "B";
	}
}
$filename = "%FILENAME%";
imagepng($dest, $filename);

print '<html>
<head>
<link rel="stylesheet" type="text/css" href="iframe.css">
</head><body>
<img src='.$filename.' alt="after">
</body></html>';
imagedestroy($image);
imagedestroy($dest);
?>