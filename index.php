<?php

//tinas github repo   https://github.com/tostrander/diner/
// this is my CONTROLLER for the diner project

//turn  on error eporting
ini_set('display_errors',1);
error_reporting(E_ALL);


//start a session

//Require the autoload file
require_once('vendor/autoload.php');

//Test Data Layer Class


//start a session after requiring autoload.php
session_start();

//Test Data Layer Class
$dataLayer = new DataLayer();
$myOrder = new Order('gyros','dinner',"Tziki, pickles");
$id = $dataLayer->saveOrder($myOrder);
echo "$id inserted successfully";

//var_dump($_SESSION);
//require_once ('classes/order.php');  //run composer update in ssh session every time you update or create a new class


/*
$myOrder = new Order();
$myOrder->setFood("tacos");
echo "<p>".$myOrder->getFood()."<p>";
$myOrder->setMeal("4th meal");
echo "<p>".$myOrder->getMeal()."<p>";
$myOrder->setCondiments("sour cream");
echo "<p>".$myOrder->getCondiments()."<p>";
var_dump($myOrder);
//var_dump(getMeals());

/*
$food1 = "tacos";
$food2 = "";
$food3 = "x";

echo validFood($food1) ? "valid" : "not valid";
*/


//Instantiate the F3 Base class ( fat-free object)
$f3 = Base::instance();

//Instantiate a Controller object
$con = new Controller($f3);


//Define a default route(328/diner) with an annoymous function that instantiates a template object that renders thew home.html file in the view directory
$f3 ->route('GET /',function() {

   $GLOBALS['con']->home();
});


//define a breakfast route(328/diner/breakfast
// when a user writes breakfast into the url, we route to breakfast.html
$f3 ->route('GET /breakfast',function() {

   $GLOBALS['con']->breakfast();
});

//define a breakfast route(328/diner/breakfast
// when a user writes breakfast into the url, we route to breakfast.html
$f3 ->route('GET /lunch',function() {

    //instantiate a view
    $view = new Template();

    echo $view -> render("views/lunch.html");
});

$f3 ->route('GET|POST /order1',function($f3) {

    $GLOBALS['con']->order1();

});

$f3 ->route('GET|POST /order2',function($f3) {
    $GLOBALS['con']->order2();
});

$f3 ->route('GET|POST /summary',function($f3) {
    $GLOBALS['con']->summary();
});
//Run fat free
$f3->run();






