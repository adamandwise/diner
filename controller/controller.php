<?php

//328/diner/controller/controller.php


class Controller
{
    private $_f3; // represents my fat free object

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        //instantiate a view
        $view = new Template();

        echo $view -> render("views/home.html");
    }

    function breakfast()
    {
        //instantiate a view
        $view = new Template();

        echo $view -> render("views/breakfast.html");
    }

    function order1()
    {
        //if form has been submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $newOrder = new Order();

            //validation logic for food variable
            $food  = trim($_POST['food']);
            if(Validate::validFood($food)) {
                $newOrder->setFood($food);
            }  else{
                $this->_f3->set('errors["food"]',
                    'Food must have at least 2 chars');
            }

            // validation logic for meal variable
            $meal = trim($_POST['meal']);
            if(Validate::validMeal($meal)) {
                $newOrder->setMeal($meal);
                echo "meal is valid";

            }else{
                $this->_f3->set('errors["meal"]','Meals is invalid');
                echo "meal is invalid";
                echo $meal;

            }



            //redirect to summary page if the form has been posted
            // if there are no errors we can reroute
            if(empty($this->_f3->get('errors'))){
                $_SESSION['newOrder'] = $newOrder;
                $this->_f3->reroute('order2');
            }

        }

        //Add the data to the F3 hive
        $this->_f3->set('meals',DataLayer::getMeals());

        //instantiate a view
        $view = new Template();
        echo $view -> render("views/order1.html");
    }

    function order2()
    {

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
            $this->_f3->reroute('summary');
        }

        //Add the data to the F3 hive
        $this->_f3-> set('condiments', DataLayer::getCondiments());


//    if(empty($f3->get('errors'))){
//
//        $f3->reroute('summary');
//    }
        //instantiate a view
        $view = new Template();

        echo $view -> render("views/order2.html");
    }

    function summary()
    {

        //write to data base

        //instantiate a view
        $view = new Template();

        echo $view -> render("views/summary.html");

        //Destroy Session Array
        session_destroy();
    }


}