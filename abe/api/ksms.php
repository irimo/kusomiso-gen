<?php
/* Pending file */

// $image:���H�O�摜
// $dest:���H��摜
$error = false;
if(isset($_REQUEST["attach_type1"]) && isset($_REQUEST["attach1"])){
	$filename_old = ABS_PATH.date("Ymd-His");
	$img = $_REQUEST["attach1"];
	switch($_REQUEST["attach_type1"]){
		case "image/pjpeg":
		case "image/jpeg":
		 	$ext = "jpg";
			break;

		case "image/png":
		case "image/x-png":
		 	$ext = "png";
			break;

		case "image/gif":
			$ext = "gif";
			break;

		default:
			$ext = "error";
			$error = true;
	}
	$img = base64_decode($img);
	$filename_old .= ".".$ext;
	file_put_contents($filename_old, $img);
		
	switch($ext){
		case "jpg":
			$image = imagecreatefromjpeg($filename_old);
			$dest = imagecreatefromjpeg($filename_old);
			break;
			
		case "png":
			$image = imagecreatefrompng($filename_old);
			$dest = imagecreatefrompng($filename_old);
			break;
			
		case "gif":
			$image = imagecreatefromgif($filename_old);
			$dest = imagecreatefromgif($filename_old);
			break;
		default:
			$image = imagecreatetruecolor(100,100);
			$dest = imagecreatetruecolor(100,100);
				
	}
	$work = imagecreatetruecolor(1,1);	// imagecolorallocate()�̃o�O����̂��߂ɍ������摜
			
	
			
	$tex = "B";
	$maxsize = 40;
	$minsize = 3;
	
	list($w , $h) = getimagesize($filename_old);
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
			ImageTTFText($dest, $size."px", 0, $x, $y, $color, "../abea.ttf",$tex);
		}
		if($tex === "A"){
			$tex = "B";
		} else {
			$tex = "A";
		}
	}
	$filename = date("mdHisu").".jpg";
	$out_filename = ABS_PATH.$filename;
	imagejpeg($dest, $out_filename);
	
	imagedestroy($image);
	imagedestroy($dest);

} else {
	$error = true;
}
print "subject=�����݂��W�F�l���[�^�[\n";

if($error === true){
	print "body=���߂�ȁA�摜�����Ȃ������B";
} else {
	print "filepath=%IMGFOLDER%".$filename."\nbody=�E�z�b!�����摜���";
}

?>