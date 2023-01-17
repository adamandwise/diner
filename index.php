<?php
// this is my CONTROLLER for the diner project

//turn  on error eporting
ini_set('display_errors',1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Instantiate the F3 Base class ( fat-free object)
$f3 = Base::instance();



//Define a default route(328/diner) with an annoymous function that instantiates a template object that renders thew home.html file in the view directory
$f3 ->route('GET /',function() {

    //instantiate a view
    $view = new Template();

    echo $view -> render("views/home.html");
});

//Run fat free
$f3->run();






?>