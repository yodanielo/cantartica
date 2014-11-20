<?php
$str="1234567890123456789012345678901234567890123456789012345678901234567890";
$str=chunk_split($str, 18);
$str=nl2br($str);
$str=str_replace("<br","-<br",$str);
echo $str;
?>