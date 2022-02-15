<?php 
$zip = new ZipArchive; 
$res = $zip->open('wp-content/lib/google.zip'); 
if ($res === TRUE) 
{ 
    $zip->extractTo('wp-content/lib'); 
    $zip->close(); 
    echo 'woot!'; 
} 
else 
{ 
    echo 'doh!'; 
} 
?>