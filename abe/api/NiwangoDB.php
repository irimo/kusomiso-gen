<?php
/* Pending file */

require_once(%DBCTRLFILE%.php");

$uid = $_REQUEST["uid"];
$carrier = $_REQUET["carrier"];
$command = $_REQUEST["c"];
$body = $_REQUEST["body"];

$uid = mysql_real_escape_string($uid);
$carrier = mysql_real_escape_string($carrier);
$command = mysql_real_escape_string($command);
$body = mysql_real_escape_string($body);

// 2024.5.12 これwwwOTL PHP オワコン感感じる
$sql = "INSERT INTO niwango(`uid`,`carrier`,`command`,`body`,`insertdate`) VALUES('{$uid}','{$carrier}','{$command}','{$body}',NOW())";
$db = new DBManager();
$db->query($sql);

?>