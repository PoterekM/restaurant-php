<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost:8889;dbname=food_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class RestaurantTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Restaurant::deleteAll();
        }

        function testSave()
        {
            $cuisine = "turds";
            $test_cuisine = new Cuisine($cuisine);
            $executed = $test_cuisine->save();

            $name = "Fancy Pants: eat my shorts";
            $address = "333 NE 33rd Ave";
            $hours = "12pm-10pm";
            $cost = "super expensive";
            $test_restaurant_name = new Restaurant($name, $address, $hours, $cost);
            $test_restaurant_name->save();

            $executed = $test_restaurant_name->save();

            $this->assertTrue($executed, "Task not successfully saved to database");
        }

        function testGetName()
        {
            $name = "Pok Pok";
            $test_name = new Restaurant($name);

            $result = $test_name->getName();

            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            //Arrange
            $name = "pho jasmine";
            $test_name = new Restaurant($name);
            $new_name = "Homegrown Smoker";

            //Act
            $test_name->setName($new_name);
            $result = $test_name->getName();

            //Assert
            $this->assertEquals($new_name, $result);
        }

        function testDeleteAll()
        {
            $name = "Taco Bell";
            $name_2 = "Pancake House";
            $test_name = new Restaurant($name);
            $test_name->save();
            $test_name_2 = new Cuisine($name_2);
            $test_name_2->save();

            Restaurant::deleteAll();
            $result = Restaurant::getAll();

            $this->assertEquals([], $result);
        }

    }
?>
