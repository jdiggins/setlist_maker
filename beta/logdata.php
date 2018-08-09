<?php

session_start();
// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

/*
$dom = new DOMDocument();
$dom->loadHTML($html);
$xpath = new DOMXPath($dom);

$divContent = $xpath->evaluate('//div[id="song-list-wrap"]');
*/

$divContent = $_POST['data'];

$content = $divContent;
$date = new DateTime ($date);
$now = date ('Y-m-d H:i:s', time());
$username = '(User: ' . $_SESSION['username_setlist'] . ' ) (Time: ' . $now . ') ';


$my_file = 'phish_logs.txt';
$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
fwrite($handle, $username);
$new_data = $content . "\n\n";
$seperator = PHP_EOL . '--------------------------------------------------------------------------' . PHP_EOL;
$t_sep = "\r\n------------------------------------------------------------------------------\r\n";
fwrite($handle, $new_data);
fwrite($handle, $t_sep);
fclose($handle);

?>