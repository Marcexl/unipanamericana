<?php 
$zip = new ZipArchive; 
$res = $zip->open('lib/google.zip'); 
if ($res === TRUE) 
{ 
    $zip->extractTo('lib'); 
    $zip->close(); 
    echo 'woot!'; 
} 
else 
{ 
    echo 'doh!'; 
} 
?>