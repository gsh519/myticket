<?php
//画像のパスとファイル名
$fpath = '';
$fname = 'sample';

//画像のダウンロード
header('Content-Type: application/octet-stream');
header('Content-Length: ' . filesize($fpath));
header('Content-disposition: attachment; filename="' . $fname . '"');
readfile($fpath);
