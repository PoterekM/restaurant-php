<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost:8889;dbname=food_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class CuisineTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function testSave()
        {
            $cuisine = "turds";
            $test_cuisine = new Cuisine($cuisine);

            $executed = $test_cuisine->save();

            $this->assertTrue($executed, "Task not successfully saved to database");
        }

        function testGetId()
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


        function testFind()
        {
            $cuisine = "Dim Sum";
            $cuisine_2 = "Chinese";
            $test_cuisine = new Cuisine($cuisine);
            $test_cuisine->save();
            $test_cuisine_2 = new Cuisine($cuisine_2);
            $test_cuisine_2->save();

            $result = Cuisine::find($test_cuisine->getId());

            $this->assertEquals($test_cuisine, $result);
        }

        function testDeleteAll()
        {
            $cuisine = "Cereal";
            $cuisine_2 = "Pancakes";
            $test_cuisine = new Cuisine($cuisine);
            $test_cuisine->save();
            $test_cuisine_2 = new Cuisine($cuisine_2);
            $test_cuisine_2->save();

            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            $this->assertEquals([], $result);
        }

        function testGetRestaurant()
        {
            //Arrange
            $cuisine = "KFC";
            $test_cuisine = new Cuisine($cuisine);
            $test_cuisine->save();

            $cuisine_id = $test_cuisine->getId();

            $name = "ihop";
            $address = "444 NE 38th";
            $hours = "12-8";
            $cost = "$$$$";
            // $cuisine_id =
            $test_restaurant_name = new Restaurant($name, $address, $hours, $cost, $cuisine_id);
            $test_restaurant_name->save();

            $name2 = "turds";
            $address2 = "420 NE 38th";
            $hours2 = "12-12";
            $cost2 = "$$$$";
            $test_restaurant_name2 = new Restaurant($name2, $address2, $hours2, $cost2, $cuisine_id);
            $test_restaurant_name2->save();

            //Act
            $result = $test_cuisine->getRestaurant();
            // $test_cuisine->Restaurant($test_restaurant_name2);

            //Assert
            $this->assertEquals([$name, $name2], $result);
        }
    }
?>
