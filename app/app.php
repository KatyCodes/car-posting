<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__.'/../src/Car.php';
    date_default_timezone_set('America/Los_Angeles');
    session_start();

    if (empty($_SESSION['allCars'])){
      $_SESSION['allCars'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {

      if(!empty($_SESSION['allCars'])){
        var_dump($_SESSION['allCars']);
      }
      return $app['twig']->render('home.html.twig', array('car'=>Car::getAll()));
     });

     $app->post("/new_car", function() use ($app) {
       $new_car = new Car($_POST['make'], $_POST['miles'], $_POST['image'], $_POST['price']);
       $new_car->save();
       return $app['twig']->render('newcaradd.html.twig', array('car' => $new_car));
      });

    return $app;
?>
