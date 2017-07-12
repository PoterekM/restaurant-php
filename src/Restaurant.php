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


            function setAddress($new_address)
            {
                $this->address = $new_address;
            }

            function setHours($new_hours)
            {
                $this->hours = $new_hours;
            }

            function setCost($new_cost)
            {
                $this->cost = $new_cost;
            }
        }

 ?>
