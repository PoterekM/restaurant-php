<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost:8889;dbname=food_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class RestaurantTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
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
            $test_restaurant_name = new Restaurant($name, $address, $hours, $cost, $cuisine_id);
            $executed = $test_restaurant_name->save();



            $this->assertTrue($executed, "Task not successfully saved to database");
        }

        function testGetName()
        {
            $cuisine = "Pok Pok";
            $test_cuisine = new Cuisine($cuisine);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();

            $name = "Fancy Pants: eat my shorts";
            $address = "333 NE 33rd Ave";
            $hours = "12pm-10pm";
            $cost = "super expensive";
            $test_restaurant_name = new Restaurant($name, $address, $hours, $cost, $cuisine_id);
            $test_restaurant_name->save();


            $result = $test_restaurant_name->getName();

            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            //Arrange
            $cuisine = "pho jasmine";
            $test_cuisine = new Cuisine($cuisine);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();


            $name = "Fancy Pants: eat my shorts";
            $address = "333 NE 33rd Ave";
            $hours = "12pm-10pm";
            $cost = "super expensive";
            $test_restaurant_name = new Restaurant($name, $address, $hours, $cost, $cuisine_id);
            $test_restaurant_name->save();

            $test_restaurant_name->setName("Boogah");
            $result = $test_restaurant_name->getName();

            //Assert
            $this->assertEquals("Boogah", $result);
        }

        function testDeleteAll()
        {
            $cuisine = "pho jasmine";
            $test_cuisine = new Cuisine($cuisine);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();


            $name = "Fancy Pants: eat my shorts";
            $address = "333 NE 33rd Ave";
            $hours = "12pm-10pm";
            $cost = "super expensive";
            $test_restaurant_name = new Restaurant($name, $address, $hours, $cost, $cuisine_id);
            $test_restaurant_name->save();

            $name_2 = "Fancy Pants: eat my shorts";
            $address = "333 NE 33rd Ave";
            $hours = "12pm-10pm";
            $cost = "super expensive";
            $test_restaurant_name_2 = new Restaurant($name_2, $address, $hours, $cost, $cuisine_id);
            $test_restaurant_name_2->save();



            Restaurant::deleteAll();
            $result = Restaurant::getAll();

            $this->assertEquals([], $result);
        }

    }
?>
