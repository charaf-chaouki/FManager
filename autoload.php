<?php

    spl_autoload_register(function($class){
        require('src/' . $class . '.php');
    });