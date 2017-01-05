<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__.'/../src/car.php';
    session_start();

    if (empty($_SESSION['allCars'])){
      $_SESSION['allCars'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
      return $app['twig']->render('home.html.twig', array('cars' => Car::getAll()));
     });

     $app->post("/new_car", function() use ($app) {
       $new_car = new Car($_POST['make'], $_POST['price'], $_POST['miles'], $_POST['image']);
       $new_car->save();
       return $app['twig']->render('newcaradd.html.twig', array('car' => $new_car));
      });
      $app->post("/delete", function() use ($app) {
        Car::deleteAll();
        return $app['twig']->render('delete.html.twig');
       });

    return $app;
?>
