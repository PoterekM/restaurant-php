<?php

    class Cuisine

        {
            private $style;
            private $id;

            function __construct($style, $id = null)
            {
                $this->style = $style;
                $this->id = $id;


            }

            function getId()
            {
                return $this->id;
            }

            function setCuisine($new_style)
            {
                $this->style = (string) $new_style;
            }

            function getCuisine()
            {
                return $this->style;
            }

            function save()
            {
                //insert into the table cuisine and add to the column name
                $executed = $GLOBALS['DB']->exec("INSERT INTO cuisine (name) VALUES ('{$this->getCuisine()}');");
                if ($executed) {
                    $this->id = $GLOBALS['DB']->lastInsertId();
                    return true;
                } else {
                    return false;
                }
            }

            static function find($search_id)
            {
                $found_cuisine = null;
                $returned_cuisines = $GLOBALS['DB']->prepare("SELECT * FROM cuisine WHERE id = :id");
                $returned_cuisines->bindParam(':id', $search_id, PDO::PARAM_STR);
                $returned_cuisines->execute();
                foreach($returned_cuisines as $cuisine) {
                    // style is our property up above
                    //name is from our table
                    $style = $cuisine['name'];
                    $id = $cuisine['id'];
                    if ($id == $search_id) {
                        $found_cuisine = new Cuisine($style, $id);
                    }
                }
                return $found_cuisine;
            }

            function getRestaurant()
            {
                $restaurants = Array();
                $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants WHERE cuisine_id = {$this->getId()};");
                foreach($returned_restaurants as $restaurant) {
                    $name = $restaurant['restaurant_name'];
                    $address = $restaurant['address'];
                    $hours = $restaurant['hours'];
                    $cost = $restaurant['cost'];
                    $cuisine_id = $restaurant['cuisine_id'];
                    $id = $restaurant['id'];
                    $new_restaurant = new Restaurant($name, $address, $hours, $cost, $cuisine_id, $id);
                    array_push($restaurants, $new_restaurant);
                }
                return $restaurants;
            }


//There maybe a bad smell in this function too
            static function getAll()
            {
                $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisine;");
                $cuisines = array();
                foreach($returned_cuisines as $cuisine) {
                    $style = $cuisine['name'];
                    $id = $cuisine['id'];
                    $new_cuisine = new Cuisine($style, $id);
                    array_push($cuisines, $new_cuisine);
                }
                return $cuisines;
            }
            // $style-name above is from the name in the table




            static function deleteAll()
            {
//There maube an err on what is called in the delete from
                $executed = $GLOBALS['DB']->exec("DELETE FROM cuisine;");
                if ($executed) {
                    return true;
                } else {
                    return false;
                }
            }
        }




 ?>
