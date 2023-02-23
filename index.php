<?php

//tinas github repo   https://github.com/tostrander/diner/
// this is my CONTROLLER for the diner project

//turn  on error eporting
ini_set('display_errors',1);
error_reporting(E_ALL);


//start a session

//Require the autoload file
require_once('vendor/autoload.php');
//start a session after requiring autoload.php
session_start();
require_once ('model/data-layer.php');
require_once ('model/validate.php');
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



//Define a default route(328/diner) with an annoymous function that instantiates a template object that renders thew home.html file in the view directory
$f3 ->route('GET /',function() {

    //instantiate a view
    $view = new Template();

    echo $view -> render("views/home.html");
});


//define a breakfast route(328/diner/breakfast
// when a user writes breakfast into the url, we route to breakfast.html
$f3 ->route('GET /breakfast',function() {

    //instantiate a view
    $view = new Template();

    echo $view -> render("views/breakfast.html");
});

//define a breakfast route(328/diner/breakfast
// when a user writes breakfast into the url, we route to breakfast.html
$f3 ->route('GET /lunch',function() {

    //instantiate a view
    $view = new Template();

    echo $view -> render("views/lunch.html");
});

$f3 ->route('GET|POST /order1',function($f3) {


    //if form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $newOrder = new Order();

        //validation logic for food variable
        $food  = trim($_POST['food']);
        if(validFood($food)) {
            $newOrder->setFood($food);
        }  else{
            $f3->set('errors["food"]',
                'Food must have at least 2 chars');
        }

        // validation logic for meal variable
        $meal = trim($_POST['meal']);
        if(validMeal($meal)) {
            $newOrder->setMeal($meal);
            echo "meal is valid";

        }else{
            $f3->set('errors["meal"]','Meals is invalid');
            echo "meal is invalid";
            echo $meal;

        }



        //redirect to summary page if the form has been posted
        // if there are no errors we can reroute
        if(empty($f3->get('errors'))){
            $_SESSION['newOrder'] = $newOrder;
            $f3->reroute('order2');
        }

    }

    //Add the data to the F3 hive
    $f3->set('meals',getMeals());

    //instantiate a view
    $view = new Template();
    echo $view -> render("views/order1.html");
});

$f3 ->route('GET|POST /order2',function($f3) {

    //if form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //$_SESSION['conds'] = implode(",", $_POST['conds']);

        //this way
        /*
        $newOrder = $_SESSION['newOrder'];
        $condString =implode(",", $_POST['conds']);
        $newOrder ->setCondiments($condString);
        $_SESSION['newOrder']= $newOrder;
        */

        //or this way
        $condString =implode(",", $_POST['conds']);
        $_SESSION['newOrder']->setCondiments($condString);


        //redirect to summary page
        $f3->reroute('summary');
    }

    //Add the data to the F3 hive
    $f3-> set('condiments', getCondiments());


//    if(empty($f3->get('errors'))){
//
//        $f3->reroute('summary');
//    }
    //instantiate a view
    $view = new Template();

    echo $view -> render("views/order2.html");
});

$f3 ->route('GET|POST /summary',function() {

    //write to data base

    //instantiate a view
    $view = new Template();

    echo $view -> render("views/summary.html");

    //Destroy Session Array
    session_destroy();
});
//Run fat free
$f3->run();






