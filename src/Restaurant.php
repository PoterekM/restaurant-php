<?php

        class Restaurant
        {
            private $name;
            private $address;
            private $hours;
            private $cost;

            function __construct($name, $address, $hours, $cost)
            {
                $this->name = $name;
                $this->address = $address;
                $this->hours = $hours;
                $this->cost = $cost;
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

            function save()
            {
                //insert into the table cuisine and add to the column name
                $executed = $GLOBALS['DB']->exec("INSERT INTO restaurants (restaurant_name, address, hours, cost) VALUES ('{$this->getName()}', '{$this->getAddress()}', '{$this->getHours()}', '{$this->getCost()}');");
                if ($executed) {
                    $this->id = $GLOBALS['DB']->lastInsertId();
                    return true;
                } else {
                    return false;
                }
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
