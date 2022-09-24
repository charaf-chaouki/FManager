<?php
var_dump($_SERVER); exit;
//Variable Application
$dir = __DIR__ . '/files/';
$filePath = $dir . 'file1.txt';

//Check file exists
if(file_exists($filePath))
{
    //Open File
    //$file = fopen($filePath, 'r');

   // if($file)
    {
        //read content
        $html = file_get_contents($filePath);
        
        echo nl2br($html);

        //close File
       // fclose($file);
    }
}
else
{
    die('This file doesn\'t exist!');
}
