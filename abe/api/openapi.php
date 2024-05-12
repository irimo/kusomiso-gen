<?php
/* Pending file */

if(!isset($_REQUEST))return;
ob_start();
var_dump($_REQUEST);
$out = ob_get_contents();
file_put_contents("./".date("Ymd-His").".txt",$out,FILE_APPEND);

require_once("NiwangoDB.php");

?>
subject=gentest
body=testtest