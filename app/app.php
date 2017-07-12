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
    //     return $app['twig']->render('cuisine.html.twig', array('cuisines' => Cuisine::getAll()));
    // });

    $app->post("/", function() use ($app) {
        $cuisine = $_POST['cuisine'];
        $new_cuisine = new Cuisine($cuisine);
        var_dump($new_cuisine);
        $new_cuisine->save();
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));

    });


    return $app;
?>
