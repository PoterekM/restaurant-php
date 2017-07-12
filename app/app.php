<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cuisine.php";
    require_once __DIR__."/../src/Restauraunt.php";


    $server = 'mysql:host=localhost:8889;dbname=food';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use($app) {
        return $app['twig']->render('index.html.twig', array(Cuisine::getAll()));
    });

    $app->get("/cuisine", function() use($app) {
        return $app['twig']->render('cuisine.html.twig', array('restaurants' => Restaurant::getAll()));
    });

    $app->post("/cuisine", function() use ($app) {
        $style = $_POST['style'];
        $cuisine = new Cuisine($style, $id = null);
        $cuisine->save();
        return $app['twig']->render('cuisine.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    return $app;
?>
