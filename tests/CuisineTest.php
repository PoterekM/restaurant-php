<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost:8889;dbname=food_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        function getId()
        {
            //Arrange
            $cuisine = "Lebanese";
            $test_cuisine = new Cuisine($cuisine);
            $test_cuisine->save();

            //Act
            $result = $test_cuisine->getId();

            //assert
            $this->assertTrue(is_numeric($result));

        }


        function testGetFoodType()
        {
            //Arrange
            $cuisine = 'pho';
            $test_cuisine = new Cuisine($cuisine);

            //Act
            $result = $test_cuisine->getCuisine();

            //Assert
            $this->assertEquals($cuisine, $result);
        }

        function testSetFoodType()
        {
            $cuisine = "Mexican";
            $test_cuisine = new Cuisine($cuisine);
            $new_cuisine = "Ethiopian";

            $test_cuisine->setCuisine($new_cuisine);
            $result = $test_cuisine->getCuisine();

            $this->assertEquals($new_cuisine, $result);
        }

    }
?>
