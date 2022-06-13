<?php
include 'configs.php';
include 'db.php';

$vlc_path = "/requests/status.json?command=pl_play";

// create curl resource 
$ch = curl_init(); 
// set url 
curl_setopt($ch, CURLOPT_URL, $vlc_site . $vlc_path); 
curl_setopt($ch, CURLOPT_PORT, $vlc_port);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, ":$vlc_password");
// return the transfer as a string 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
// for debugging
curl_setopt($ch, CURLOPT_VERBOSE, true);
   
// $output contains the output string 
$output = curl_exec($ch); 
// close curl resource to free up system resources 
curl_close($ch);      

echo $vlc_path;
print $output;
?>