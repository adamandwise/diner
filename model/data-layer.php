<?php
class DataLayer
{


    static function getMeals()
    {
        return array("breakfast","second breakfast","lunch","dinner","dessert");
    }

    static function getCondiments()
    {
        return array("ketchup","mustard","sriracha","mayo","kimchi");
    }
}