<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Cuisine.php";
require_once "src/Restaurant.php";

$server = 'mysql:host=localhost:8889;dbname=restaurants_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class RestaurantTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Restaurant::deleteAll();
        Cuisine::deleteAll();
    }

    function test_new_Restaurant()
    {
        // Arrange
        $new_cuisine = new Cuisine('Pub', 'link1');
        $new_cuisine->save();
        $new_restaurant = new Restaurant('Sasquatch', 'Link_Sas', 'Hillsdale', $new_cuisine->getId());
        $new_restaurant->save();

        $new_cuisine2 = new Cuisine('Fast Food', 'google.com?fastfood');
        $new_cuisine2->save();
        $new_restaurant2 = new Restaurant('McDonalds', 'mcdonalds.com?location=23222424', 'NE Portland', $new_cuisine2->getId());
        $new_restaurant2->save();

        $new_restaurant3 = new Restaurant('BurgerKing', 'bk.com?location=232424', 'NE Portland', $new_cuisine2->getId());
        $new_restaurant3->save();

        // Act
        $all_restaurants = Restaurant::getAll($new_cuisine2->getId());

        // Assert
        $this->assertEquals([$new_restaurant3, $new_restaurant2], $all_restaurants);
    }

    // function test_delete_Cuisine()
    // {
    //     // Arrange
    //     $new_cuisine = new Cuisine('Pub', 'link1');
    //     $new_cuisine2 = new Cuisine('Korean', 'link2');
    //
    //     // Act
    //     $new_cuisine->save();
    //     $new_cuisine->delete();
    //     $new_cuisine2->save();
    //     $all_cuisines = Cuisine::getAll();
    //
    //     // Assert
    //     $this->assertEquals([$new_cuisine2], $all_cuisines);
    // }
    //
    // function test_update_Cuisine()
    // {
    //     // Arrange
    //     $new_cuisine = new Cuisine('Pub', 'link1');
    //     $new_cuisine2 = new Cuisine('Korean', 'link2');
    //
    //     // Act
    //     $new_cuisine->save();
    //     $new_cuisine2->save();
    //
    //     $new_cuisine->update('American', $new_cuisine->getLink());
    //     $new_cuisine2->update($new_cuisine2->getName(), 'link2update');
    //
    //     $all_cuisines = Cuisine::getAll();
    //
    //     // Assert
    //     $this->assertEquals([$new_cuisine, $new_cuisine2], $all_cuisines);
    // }
}
?>
