<?php

/**
 * Order class represents an order from my diner
 * @Adam Wise
 */


class Order
{
    private $_food;
    private $_meal;
    private $_condiments;

    function __construct($food="",$meal="",$condiments="")
    {
        $this->_food = $food;
        $this->_meal = $meal;
        $this->_condiments = $condiments;
    }

    /**
     * getFood returns the food item ordered
     * @return string
     */

    public function getFood()
    {
        return $this->_food;
    }

    /**
     * setFood sets a food item in the order
     * @param $food ( String)
     * @return void
     */
    public function setFood($food)
    {
        $this->_food = $food;
    }

    /**getCondiments return the meal type
     * @return string
     */
    public function getMeal()
    {
        return $this->_meal;
    }

    /**
     * setCondiments changes the meal type to a specified string set in a parameter
     */
    public function setMeal($meal)
    {
        $this->_meal = $meal;
    }

    /**getCondiments return the condiment type
     * @return string
     */
    public function getCondiments()
    {
        return $this->_condiments;
    }

    /**
     * setCondiments changes the condiment to a specified string set in a parameter
     */
    public function setCondiments($condiments)
    {
        $this->_condiments = $condiments;
    }
}