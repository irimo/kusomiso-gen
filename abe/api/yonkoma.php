<?php

/* Pending file */

require_once %GIFANIMECTRLFILE%";
//***************
// �Y�t�摜��ۊ�
//***************
$error = true;
$img_arr = array();
$i = 1;
while(isset($_REQUEST["attach_type".$i]) && isset($_REQUEST["attach".$i])){
	$error = false;
    switch($_REQUEST["attach_type".$i]){
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
    }
    $img = base64_decode($_REQUEST["attach".$i]);
    $filename_old = TMP_IMG_DIR."/".date("Ymd-His");
    file_put_contents($filename_old.".".$ext, $img);
	switch($ext){
		case "jpg":
			$src = imagecreatefromjpeg($filename_old.".".$ext);
			imagegif($src,$filename_old.".gif");
			break;
		case "png":
			$src = imagecreatefrompng($filename_old.".".$ext);
			imagegif($src,$filename_old.".gif");
			break;
		default:
	}
	$img_arr[] = $filename_old.".gif";
    $i++;
}
if($error === false){
	//***************
	// �f�B���C���擾
	//***************
	$def_delay = 2;	// 2sec.
	$max = $i;
	for($i=1; $i<$max; $i++){
     $delay_arr[] = $def_delay * 100;
	}
	
	//***************
	// �A�j���[�V�������쐬
	//***************
	$aniclass = new CreateGifAnimeFromImage($img_arr);
	$aniclass->setSecond($delay_arr);
	$aniclass->setLoop(0);
	$aniclass->create();
	$url = $aniclass->getImgUrl();
}
//***************
// ���X�|���X
//***************
print "subject=4�R�}�W�F�l���[�^�[\n";
if($error === true){
    print "body=���߂�Ȃ����i���Q���j\n�摜���ǂݍ��߂܂���ł����B�B";
} else {
    print "filepath=".$url."\n";
    print "body=4�R�}�����͂����܂���";
}
?>
