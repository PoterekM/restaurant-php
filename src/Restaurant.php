<?php

        class Restaurant
        {
            private $name;
            private $address;
            private $hours;
            private $cost;
            private $cuisine_id;
            private $id;

            function __construct($name, $address, $hours, $cost, $cuisine_id, $id = null)
            {
                $this->name = $name;
                $this->address = $address;
                $this->hours = $hours;
                $this->cost = $cost;
                $this->cuisine_id = $cuisine_id;
                $this->id = $id;
            }

            function getId()
            {
                return $this->id;
            }

            function setName($new_name)
            {
                $this->name = $new_name;
            }

            function getName()
            {
                return $this->name;
            }

            function setAddress($new_address)
            {
                $this->address = $new_address;
            }

            function getAddress()
            {
                return $this->address;
            }

            function setHours($new_hours)
            {
                $this->hours = $new_hours;
            }

            function getHours()
            {
                return $this->hours;
            }

            function setCost($new_cost)
            {
                $this->cost = $new_cost;
            }

            function getCost()
            {
                return $this->cost;
            }

            function setCuisineId($new_ciusine_id)
            {
                $this->cuisine_id = $new_ciusine_id;
            }

            function getCuisineId()
            {
                return $this->cuisine_id;
            }
            function save()
            {
                //insert into the table cuisine and add to the column name
                $executed = $GLOBALS['DB']->exec("INSERT INTO restaurants (restaurant_name, address, hours, cost, cuisine_id) VALUES ('{$this->getName()}', '{$this->getAddress()}', '{$this->getHours()}', '{$this->getCost()}', {$this->getCuisineId()});");
                if ($executed) {
                    $this->id = $GLOBALS['DB']->lastInsertId();
                    return true;
                } else {
                    return false;
                }
            }

            static function getAll()
            {
                $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
                $restaurants = array();
                foreach($returned_restaurants as $restaurant) {
                    $name = $restaurant['restaurant_name'];
                    $address = $restaurant['address'];
                    $hours = $restaurant['hours'];
                    $cost = $restaurant['cost'];
                    $cuisine_id = $restaurant['cuisine_id'];
                    $id = $restaurant['id'];
                    $new_restaurant = new Restaurant($name, $address, $hours, $cost, $cuisine_id, $id);
                    array_push($restaurants, $new_restaurant);
                    ///Michelle is worried about not getting id in here
                }
                return $restaurants;
            }

            static function deleteAll()
            {
                $executed = $GLOBALS['DB']->exec("DELETE FROM restaurants;");
                if ($executed) {
                    return true;
                } else {
                    return false;
                }
            }

        }

        ?>
