<?php
require $_SERVER['DOCUMENT_ROOT'].'/../pdo-config.php';
//require('/home/adamthew/pdo-config.php');

/**
 * a class that holds my data layer, basically the two arrays that hod
 */
class DataLayer
{
    private $_dbh;

    function __construct()
    {
        // Database connection

        try{
            //Instantiate a PDO object

            $this->_dbh = new PDO(DB_DRIVER,USERNAME,PASSWORD);

        }catch(PDOException $e){
            echo $e->getMessage();

        }
    }

    function saveOrder($orderObj)
    {
        //1.Define the query
        $sql = "INSERT INTO orders (food, meal, conds) VALUE (:food,:meal,:conds)";

        //2. Prepare the Statement
        $statement = $this->_dbh -> prepare($sql);

        //3. Bind the parameters
        $food = $orderObj->getFood();
        $meal = $orderObj->getMeal();
        $conds = $orderObj->getCondiments();
        $statement->bindParam(':food',$food);
        $statement->bindParam(':meal',$meal);
        $statement->bindParam(':conds',$conds);

        //4. Execute the query
        $statement->execute();

        //5.process the result
        $id = $this->_dbh->lastInsertId();
        return $id;
    }

    static function getMeals()
    {
        return array("breakfast","second breakfast","lunch","dinner","dessert");
    }

    static function getCondiments()
    {
        return array("ketchup","mustard","sriracha","mayo","kimchi");
    }
}