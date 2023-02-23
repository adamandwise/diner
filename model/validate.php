<?php

class Validate
{


    //return true if the food has at least two characters
    static function validFood($food)
    {
        /* two different ways to say this

        basically the foods need to have at least 2 characters
        if(strlen($food) <= 2){
            return false;
        }
        else{
            return true;
        }*/

        return strlen($food) > 2;
    }


    static function validMeal($meal)
    {

        if (in_array($meal, DataLayer::getMeals())) {
            return true;
        } else {
            return false;
        }
        echo $meal;
        var_dump(getMeals());
        // return in_array($meal,getMeals());
    }

    function validConds($conds)
    {
        return in_array($conds, DataLayer::getCondiments());
    }

}


