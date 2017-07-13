<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cuisine.php";
    require_once __DIR__."/../src/Restaurant.php";


    $server = 'mysql:host=localhost:8889;dbname=food';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();


    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use($app) {
        return $app['twig']->render('index.html.twig', array(Cuisine::getAll()));
    });

    // $app->get("/", function() use($app) {
    //     return $app['twig']->render('index.html.twig', array(Restaurant::getAll()));
    // });

    $app->post("/", function() use ($app) {
        $cuisine = $_POST['cuisine'];
        $new_cuisine = new Cuisine($cuisine);
        // var_dump($cuisine);

        $new_cuisine->save();
        return $app['twig']->render('add_restaurant.html.twig', array('cuisines' => Cuisine::getAll()));

    });

    $app->post("/add_restaurant", function() use ($app) {
        $name = $_POST['name'];
        var_dump($name);
        $address = $_POST['address'];
        var_dump($address);
        $hours = $_POST['hours'];
        $cost = $_POST['cost'];
        $restaurant = new Restaurant($name, $address, $hours, $cost);
        $restaurant->save();
        var_dump($restaurant);
        return $app['twig']->render('add_restaurant.html.twig', array('restaurants' =>Restaurant::getAll()));

    });

    $app->get("/add_restaurants/{id}", function($id) use ($app) {
        $new_cuisine = Cuisine::find($id);
        return $app['twig']->render('add_restaurants.html.twig', array('cuisines' => $new_cuisine, 'restaurants' => $restaurant->getTasks()));
    });

    $app->post("/delete_cuisine", function() use ($app) {
        Cuisine::deleteAll();
        return $app['twig']->render('delete_cuisine.html.twig');
    });

    $app->post("/delete_restaurants", function() use ($app) {
        Restaurant::deleteAll();
        return $app['twig']->render('delete_restaurants.html.twig');
    });

    return $app;
?>
