<?php
    require('env.php');

    $dir = ROOT_DIR;

    $fdir = new FDir();

    $fileToDownload = $_GET['path'];

    var_dump($fileToDownload);

?>