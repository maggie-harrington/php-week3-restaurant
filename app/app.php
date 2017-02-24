<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cuisine.php";
    require_once __DIR__."/../src/Restaurant.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $server = 'mysql:host=localhost:8889;dbname=restaurants';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        $edit_cuisine = new Cuisine('','');

        return $app['twig']->render(
            'cuisines.html.twig',
            array('cuisines' => Cuisine::getAll(), 'edit_cuisine' => $edit_cuisine, 'is_edit' => false)
        );
    });

    $app->get("/get/cuisine/{id}", function($id) use ($app) {
        $edit_cuisine = Cuisine::findById($id);

        return $app['twig']->render(
            'cuisines.html.twig',
            array('cuisines' => Cuisine::getAll(), 'edit_cuisine' => $edit_cuisine, 'is_edit' => true)
        );
    });

    $app->patch("/patch/cuisine/{id}", function($id) use ($app) {
        $edit_cuisine = Cuisine::findById($id);
        $edit_cuisine->update(
            $_POST['cuisine_name'],
            $_POST['cuisine_link']
        );
        $edit_cuisine = new Cuisine('','');

        return $app['twig']->render(
            'cuisines.html.twig',
            array('cuisines' => Cuisine::getAll(), 'edit_cuisine' => $edit_cuisine, 'is_edit' => false)
        );
    });

    $app->delete("/delete/cuisine/{id}", function($id) use ($app) {
        $delete_cuisine = Cuisine::findById($id);
        $delete_cuisine->delete();
        $edit_cuisine = new Cuisine('','');

        return $app['twig']->render(
            'cuisines.html.twig',
            array('cuisines' => Cuisine::getAll(), 'edit_cuisine' => $edit_cuisine, 'is_edit' => false)
        );
    });

    $app->post("/post/cuisine", function() use ($app) {
        $new_cuisine = new Cuisine($_POST['cuisine_name'], $_POST['cuisine_link']);
        $new_cuisine->save();
        $edit_cuisine = new Cuisine('','');

        return $app['twig']->render(
            'cuisines.html.twig',
            array('cuisines' => Cuisine::getAll(), 'edit_cuisine' => $edit_cuisine, 'is_edit' => false)
        );
    });

    $app->post("/post/restaurant", function() use ($app) {
        $cuisine_id = $_POST['cuisine_id'];
        $new_restaurant = new Restaurant(
            $_POST['restaurant_name'],
            $_POST['restaurant_link'],
            $_POST['restaurant_location'],
            $cuisine_id
        );
        $new_restaurant->save();

        return $app['twig']->render(
            'restaurants.html.twig',
            array('restaurants' => Restaurant::getAll($cuisine_id), 'cuisine' => Cuisine::findById($cuisine_id))
        );
    });

    $app->get("/get/restaurants/{cuisine_id}", function($cuisine_id) use ($app) {
        return $app['twig']->render(
            'restaurants.html.twig',
            array('restaurants' => Restaurant::getAll($cuisine_id), 'cuisine' => Cuisine::findById($cuisine_id))
        );
    });

    return $app;
?>
