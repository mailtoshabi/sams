
<?php
 $target = $_SERVER['DOCUMENT_ROOT'] . '/sams/storage/app/public';
 $link = $_SERVER['DOCUMENT_ROOT'] . '/sams/public/storage';





 symlink($target, $link);
?>
